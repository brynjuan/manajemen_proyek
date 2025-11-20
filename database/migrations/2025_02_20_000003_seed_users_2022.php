<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Data Mahasiswa Teknik Informatika (F551) - Angkatan 2022
        $students_ti_22 = [
            ['F551 22 024', 'Andi Azhar Darmawan'],
            ['F551 22 031', 'Moh. Arief Gunady'],
            ['F551 22 038', 'Lukman Hakim'],
            ['F551 22 041', 'Melsi Rosdiana'],
            ['F551 22 054', 'Abdiansyah Ampaka'],
            ['F551 22 064', 'Anang Rama Mantaws'],
            ['F551 22 001', 'Dimaz Anugrahman Yusuf'],
            ['F551 22 002', 'Fahruddin A. Lebe'],
            ['F551 22 003', 'Rizka Annisa'],
            ['F551 22 004', 'Adelia Cesar'],
            ['F551 22 005', 'Moh.Risky Mardjuku'],
            ['F551 22 006', 'Rio Reifan'],
            ['F551 22 007', 'Irma Sitti Rahma'],
            ['F551 22 008', 'Hairul'],
            ['F551 22 009', 'Miftahul Zannah'],
            ['F551 22 010', 'Nurul Aprilia'],
            ['F551 22 011', 'Aril. S'],
            ['F551 22 012', 'Rizky Ardhiansyah'],
            ['F551 22 013', 'Tjoet Muty Ahmad'],
            ['F551 22 014', 'Ahmad Thaifur'],
            ['F551 22 015', 'Olifiana'],
            ['F551 22 018', 'Dian Meldayani'],
            ['F551 22 020', 'Syafa\'at Ramadhan'],
            ['F551 22 021', 'Muhamad Fudhail'],
            ['F551 22 023', 'Hidayatul Fatwa'],
            ['F551 22 026', 'Dirda Megantara'],
            ['F551 22 027', 'Aisyah Nabila Rahmawati'],
            ['F551 22 030', 'Annisa Airinadita'],
            ['F551 22 034', 'Andi Amanda Andi Tallagu'],
            ['F551 22 036', 'Fitra Novtariadi'],
            ['F551 22 037', 'Nyoman Dwipa Putra'],
            ['F551 22 039', 'Rezha Aldino Rizaldi'],
            ['F551 22 042', 'Muh Afdal Maedja'],
            ['F551 22 046', 'Sitti Nispa'],
            ['F551 22 047', 'Andi Faturrahman'],
            ['F551 22 049', 'Diva Dwicitra Dewi'],
            ['F551 22 050', 'Ahmad Afil'],
            ['F551 22 051', 'Muhammad Fitra Wibawa'],
            ['F551 22 052', 'Muhammad Nursam'],
            ['F551 22 055', 'Yudho Prasetyo'],
            ['F551 22 056', 'Sophia Imawaty. Ar'],
            ['F551 22 058', 'Abd. Muis Royansyah'],
            ['F551 22 060', 'Mirna Wati K. Beluano'],
            ['F551 22 062', 'Moh Rafiq Dotinggulo'],
            ['F551 22 063', 'Mochammad Fachri'],
            ['F551 22 065', 'Gilang Rezi Puspitasari'],
            ['F551 22 071', 'Muhammad Farhan Saleh'],
            ['F551 22 072', 'Pradigta'],
            ['F551 22 074', 'Andi Albukhari Fachrurrozi']
        ];

        // Data Mahasiswa Sistem Informasi (F521) - Angkatan 2022
        $students_si_22 = [
            ['F521 22 017', 'Hamzah Sayyaf Al\' Amrie'],
            ['F521 22 023', 'Zahri Muhammad'],
            ['F521 22 031', 'Della Adhisty'],
            ['F521 22 027', 'Moh. Rafiq Abadi'],
            ['F521 22 003', 'Ipham Ahmad Fahrezy Farid'],
            ['F521 22 004', 'Marsha Vania Chiarasani'],
            ['F521 22 005', 'Alda Arum'],
            ['F521 22 006', 'Aisyah Syahskiah Sunandar'],
            ['F521 22 007', 'Ayu Andira'],
            ['F521 22 008', 'Moh. Fitran'],
            ['F521 22 009', 'Siti Wahyuni. S'],
            ['F521 22 010', 'Annisa Tiffany Putri'],
            ['F521 22 011', 'Siti Aminah'],
            ['F521 22 012', 'Muh. Ashari Rasyid'],
            ['F521 22 013', 'I Kadek Ardi Septadana'],
            ['F521 22 014', 'Fadya Amalia Moidady'],
            ['F521 22 015', 'Bima Sakti'],
            ['F521 22 016', 'Tesya Feronika Baresi'],
            ['F521 22 018', 'Sonya Tandi Barung'],
            ['F521 22 019', 'Mega Febriani'],
            ['F521 22 021', 'Gisli Maulana Putrawi'],
            ['F521 22 022', 'Yasin Ramadhan'],
            ['F521 22 024', 'Christian Sutan Yustino Manalu'],
            ['F521 22 026', 'Jr Agung Pramudya'],
            ['F521 22 028', 'Nur Shinta Faradika.M.U. Nggio'],
            ['F521 22 032', 'Anisa Putri']
        ];

        $data = [];
        $now = now();
        $password = Hash::make('password');

        // Helper function untuk proses data
        $processStudents = function($students, $prodi) use ($password, $now) {
            $result = [];
            foreach ($students as $student) {
                // Format NIM: hilangkan spasi (F551 22 024 -> F55122024)
                $nim = str_replace(' ', '', $student[0]);
                
                // Format Email: [NIM]@gmail.com
                $email = $nim . '@gmail.com';

                $result[] = [
                    'name' => $student[1],
                    'nim' => $nim,
                    'email' => $email,
                    'password' => $password,
                    'role' => 'anggota',
                    'prodi' => $prodi,
                    'tahun_angkatan' => '2022',
                    'qr_data' => (string) Str::uuid(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            return $result;
        };

        // Gabungkan data 2022 (TI & SI)
        $data = array_merge(
            $processStudents($students_ti_22, 'Teknik Informatika'),
            $processStudents($students_si_22, 'Sistem Informasi')
        );

        // Insert menggunakan upsert agar tidak error jika data sudah ada
        DB::table('users')->upsert(
            $data,
            ['nim'], // Kolom unik yang dicek
            ['name', 'prodi', 'tahun_angkatan', 'updated_at'] // Kolom yang diupdate
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus data berdasarkan angkatan 2022
        DB::table('users')->where('tahun_angkatan', '2022')->delete();
    }
};