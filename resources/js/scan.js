import { Html5Qrcode } from 'html5-qrcode';

const STATUS_CLASS_MAP = {
    success: 'bg-green-50 text-green-800 border border-green-200',
    warning: 'bg-amber-50 text-amber-800 border border-amber-200',
    error: 'bg-red-50 text-red-800 border border-red-200',
};

const clearStatusClasses = (element) => {
    Object.values(STATUS_CLASS_MAP).forEach((classes) => {
        element.classList.remove(...classes.split(' '));
    });
};

const showMessage = (element, status, message) => {
    if (!element) {
        return;
    }

    clearStatusClasses(element);
    element.classList.remove('hidden');
    element.classList.add('block');

    const classes = STATUS_CLASS_MAP[status] ?? STATUS_CLASS_MAP.error;
    element.classList.add(...classes.split(' '));
    element.textContent = message;
};

window.renderMeetingScanner = ({ elementId, endpoint, messageContainerId }) => {
    const messageContainer = document.getElementById(messageContainerId);
    const mountElement = document.getElementById(elementId);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

    if (!mountElement) {
        return;
    }

    const readerId = `${elementId}-reader`; // create dedicated container for html5-qrcode
    mountElement.innerHTML = `<div id="${readerId}" class="rounded-xl overflow-hidden"></div>`;

    const html5QrCode = new Html5Qrcode(readerId);
    let isProcessing = false;
    let scanningActive = false;

    const startScanner = async () => {
        try {
            const devices = await Html5Qrcode.getCameras();

            if (!devices || devices.length === 0) {
                showMessage(messageContainer, 'error', 'Kamera tidak ditemukan. Pastikan perangkat memiliki kamera.');
                return;
            }

            const preferredDevice = devices.find((device) => device.label.toLowerCase().includes('back')) ?? devices[0];

            await html5QrCode.start(
                { deviceId: { exact: preferredDevice.id } },
                { fps: 10, qrbox: { width: 240, height: 240 } },
                async (decodedText) => {
                    if (isProcessing) {
                        return;
                    }

                    isProcessing = true;

                    try {
                        await html5QrCode.pause(true);

                        const response = await fetch(endpoint, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ qr_data: decodedText }),
                        });

                        let data = {};

                        try {
                            data = await response.json();
                        } catch (error) {
                            data = {};
                        }

                        const status = data.status ?? (response.ok ? 'success' : 'error');

                        let message = data.message ?? (response.ok ? 'Absen berhasil diproses.' : 'Terjadi kesalahan.');
                        if (data.name) {
                            message = `${message} (${data.name})`;
                        }

                        showMessage(messageContainer, status, message);
                    } catch (error) {
                        showMessage(messageContainer, 'error', 'Gagal memproses data. Silakan coba lagi.');
                    } finally {
                        setTimeout(async () => {
                            try {
                                await html5QrCode.resume();
                            } catch (resumeError) {
                                // ignore resume errors
                            }

                            isProcessing = false;
                        }, 1500);
                    }
                },
                () => {
                    // ignore scan failures but keep UI responsive
                }
            );

            scanningActive = true;
        } catch (error) {
            showMessage(
                messageContainer,
                'error',
                'Tidak dapat mengakses kamera. Pastikan izin kamera diberikan pada browser.'
            );
        }
    };

    const cleanup = async () => {
        try {
            if (scanningActive) {
                await html5QrCode.stop();
                scanningActive = false;
            }
        } catch (error) {
            // ignore stop errors
        } finally {
            html5QrCode.clear();
        }
    };

    startScanner();

    window.addEventListener('pagehide', cleanup, { once: true });
    window.addEventListener('beforeunload', cleanup, { once: true });
};

