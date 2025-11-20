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
        // Data Mahasiswa Teknik Informatika (F551) - Angkatan 2021
        $students_ti_21 = [
            ['F551 21 001', 'Andi Wulan Wahyuni'],
            ['F551 21 015', 'Wahyudi Mansyur'],
            ['F551 21 019', 'Tasya Mulfiana'],
            ['F551 21 025', 'Aisyah Tiaza Putri'],
            ['F551 21 036', 'Enisa Nilasari'],
            ['F551 21 041', 'M. Akbar Tawil'],
            ['F551 21 048', 'ADRI ALFAR'],
            ['F551 21 050', 'Reski Dwi Ramadhani'],
            ['F551 21 052', 'Royan Al Qois'],
            ['F551 21 053', 'Tiara Juli Arista'],
            ['F551 21 055', 'Sri Putrianti Mateka'],
            ['F551 21 056', 'Nadya Afriyani Azmi'],
            ['F551 21 067', 'Fauzan Dwi Gunawan'],
            ['F551 21 069', 'Nurul Aliyah D.S'],
            ['F551 21 107', 'Salsa Syawaliah Kurniawani '],
            ['F551 21 002', 'Vidya Az Zahra'],
            ['F551 21 004', 'Indah Rizki Rahmawati'],
            ['F551 21 005', 'Edward C. Jefka G.'],
            ['F551 21 006', 'Felisya Brigita T. Wong'],
            ['F551 21 007', 'Andi Nirina Nursiana Zasqia'],
            ['F551 21 008', 'Muhammad Ryhan'],
            ['F551 21 011', 'Hairul Yasin'],
            ['F551 21 012', 'Ni’ma Tusyafa’ah'],
            ['F551 21 017', 'Munawir'],
            ['F551 21 018', 'Siti Nuraini Maitala'],
            ['F551 21 020', 'Syarif M. Syakur'],
            ['F551 21 022', 'Wahid Radikal Akhlak'],
            ['F551 21 023', 'Indira Yulianti'],
            ['F551 21 026', 'Melsy Patricia Anggelina'],
            ['F551 21 028', 'Siti Fajriah'],
            ['F551 21 029', 'Abdi Naavi’al Umam S.'],
            ['F551 21 030', 'Sahron Angelina I.'],
            ['F551 21 033', 'Aulia Intan Prasasti'],
            ['F551 21 035', 'Naufal Syafiq Hambali'],
            ['F551 21 037', 'Muh. Fajrin Aljabar'],
            ['F551 21 039', 'Rivaldi Sabala'],
            ['F551 21 040', 'Sahrul'],
            ['F551 21 042', 'Rahmad A.R. Dg. Matutu'],
            ['F551 21 043', 'Abib Raifmuaffah ihwan'],
            ['F551 21 045', 'Putri Innayah mahmid'],
            ['F551 21 046', 'Hajriansah'],
            ['F551 21 047', 'Nur Fadillah'],
            ['F551 21 049', 'Asep Permadi'],
            ['F551 21 051', 'Hijra S. Otji'],
            ['F551 21 054', 'Aisyah Rahmadani Pohontu'],
            ['F551 21 057', 'Afifa Wulandari'],
            ['F551 21 058', 'Niluh Nia Devi'],
            ['F551 21 059', 'Yoga DwiSatya Giri'],
            ['F551 21 060', 'Isra Septia Cahyani'],
            ['F551 21 061', 'Andika R. Atilu'],
            ['F551 21 062', 'Ade Sinta'],
            ['F551 21 063', 'Moh. Jihad Khalid'],
            ['F551 21 064', 'Budi Agung Fajariyanto'],
            ['F551 21 065', 'Nurul Rahmadani H Suryanto'],
            ['F551 21 066', 'Muammar Arianto'],
            ['F551 21 070', 'Yunita Anggraeni'],
            ['F551 21 071', 'Widya Ayunindya P.'],
            ['F551 21 073', 'Moh. Isran'],
            ['F551 21 074', 'Valda Laura Uswary'],
            ['F551 21 076', 'Agym Mahaputra P.B'],
            ['F551 21 079', 'Hidayatullah'],
            ['F551 21 080', 'Wahyu Farel'],
            ['F551 21 082', 'Febriyadi'],
            ['F551 21 083', 'Muhammad Hanif Risqi'],
            ['F551 21 087', 'Asriani'],
            ['F551 21 088', 'Dendy Kurniawan'],
            ['F551 21 089', 'Marcelino Patallo'],
            ['F551 21 090', 'Mira Cahyati'],
            ['F551 21 092', 'Stasia Olfiani parewa'],
            ['F551 21 093', 'Maftuh Ahnan Saing'],
            ['F551 21 095', 'Rabiatul Adawiah Djalali'],
            ['F551 21 098', 'Dita Widayanti Setiawan'],
            ['F551 21 100', 'Rifky Agung Chrisatya'],
            ['F551 21 105', 'Muh. Fikri Firman'],
            ['F551 21 110', 'Yulius Laki'],
            ['F551 21 112', 'Faiqah Ferarista Hamu'],
            ['F551 21 115', 'Moh. fadi fauzan Al-farizi']
        ];

        // Data Mahasiswa Sistem Informasi (F521) - Angkatan 2021
        $students_si_21 = [
            ['F521 21 010', 'Noel Marcell Jonathan Wongkar'],
            ['F521 21 027', 'Imam Fauzi'],
            ['F521 21 002', 'Inul Daratista'],
            ['F521 21 003', 'Zulfikar'],
            ['F521 21 005', 'Latifa Ayu Saputri'],
            ['F521 21 012', 'Alif Surya Ningsih'],
            ['F521 21 013', 'Fitri Wulandari'],
            ['F521 21 014', 'Sultan Akasse'],
            ['F521 21 015', 'Rahmatutsani'],
            ['F521 21 016', 'Ficky Zalfiandi'],
            ['F521 21 019', 'Salsa Dilah Priska'],
            ['F521 21 028', 'Moh. Rafiq'],
            ['F521 21 029', 'Rahmat Rifki R.'],
            ['F521 21 033', 'M. Aldi Saputra'],
            ['F521 21 034', 'Elyana Aulia Chandra'],
            ['F521 21 036', 'Moh. Riza A. Sondeng'],
            ['F521 21 037', 'Moh. Agni Algifari'],
            ['F521 21 038', 'Vicky R.A. Alfahreza'],
            ['F521 21 041', 'Rif’an Abdillah'],
            ['F521 21 046', 'Novianti'],
            ['F521 21 050', 'Moh. Fahrul'],
            ['F521 21 052', 'Aidil Adha Tingkai'],
            ['F521 21 053', 'Nurfadilah Masudijono']
        ];

        $data = [];
        $now = now();
        $password = Hash::make('password');

        // Helper function untuk proses data
        $processStudents = function($students, $prodi) use ($password, $now) {
            $result = [];
            foreach ($students as $student) {
                // Format NIM: hilangkan spasi (F551 21 001 -> F55121001)
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
                    'tahun_angkatan' => '2021',
                    'qr_data' => (string) Str::uuid(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            return $result;
        };

        // Gabungkan data 2021 (TI & SI)
        $data = array_merge(
            $processStudents($students_ti_21, 'Teknik Informatika'),
            $processStudents($students_si_21, 'Sistem Informasi')
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
        // Hapus data berdasarkan angkatan 2021
        DB::table('users')->where('tahun_angkatan', '2021')->delete();
    }
};
