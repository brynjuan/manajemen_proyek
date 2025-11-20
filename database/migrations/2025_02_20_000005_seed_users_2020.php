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
        // Data Mahasiswa Teknik Informatika (F551) - Angkatan 2020
        $students_ti_20 = [
            ['F551 20 021', 'Fahrul Rouzy'],
            ['F551 20 102', 'Muhammad Sulham'],
            ['F551 20 109', 'Gita Pratiwi Rundulemo Mangkey'],
            ['F551 20 126', 'Bayu Dwi Dirgantara'],
            ['F551 20 006', 'Ahmad Mustamin'],
            ['F551 20 007', 'Khairunnisa'],
            ['F551 20 013', 'Fadhilah Lamangkona'],
            ['F551 20 016', 'Imam Zaid Azizi'],
            ['F551 20 018', 'Khairul Insan Karim'],
            ['F551 20 022', 'Widianingrum'],
            ['F551 20 023', 'Tiara Aurellya Mongi'],
            ['F551 20 025', 'Usama'],
            ['F551 20 030', 'Hesti Puspitasari'],
            ['F551 20 033', 'M. Fahril'],
            ['F551 20 037', 'Oleve Angelson'],
            ['F551 20 041', 'Muhammad Awan Ardy F.'],
            ['F551 20 043', 'Hairul Anwar'],
            ['F551 20 045', 'Nuri Iman Sari'],
            ['F551 20 047', 'Bernadeth Putri Meo'],
            ['F551 20 052', 'Ade Gaffur'],
            ['F551 20 054', 'Salman Faris'],
            ['F551 20 056', 'Isma'],
            ['F551 20 058', 'Sri Putriana'],
            ['F551 20 067', 'Nur Riska Salsabila'],
            ['F551 20 068', 'Muhammad Fadhil'],
            ['F551 20 071', 'Arief Rahman Hakim'],
            ['F551 20 075', 'Diza Ervillia Erlita'],
            ['F551 20 076', 'Faiz Abdulghani Sarika'],
            ['F551 20 079', 'Ahmad Hidayatullah Nur Pratikta'],
            ['F551 20 080', 'Mariani'],
            ['F551 20 081', 'Muhammad Fitrah Ramadhan'],
            ['F551 20 082', 'Zulfikar Alip Takasihaeng'],
            ['F551 20 085', 'Andyzar Algifari'],
            ['F551 20 092', 'Asmaun Hasyanah Sary'],
            ['F551 20 094', 'Nabilah Putri Renggah'],
            ['F551 20 096', 'Dwiki Herdinanditya'],
            ['F551 20 099', 'Iga Mawarni'],
            ['F551 20 103', 'A\'an Praja Kurniawan'],
            ['F551 20 104', 'Moh Rizki'],
            ['F551 20 105', 'Sharkia Amalia'],
            ['F551 20 106', 'Andi Muhammad Faqih Fajar'],
            ['F551 20 111', 'Wulan Maharni'],
            ['F551 20 114', 'Andi Maha Izzah Ghazwani'],
            ['F551 20 115', 'Muhammad Dival Maulana'],
            ['F551 20 116', 'Erma Sulistiawati'],
            ['F551 20 119', 'Andika Dwiyanto'],
            ['F551 20 121', 'Resti Amanda'],
            ['F551 20 122', 'Djafar Siddiq Assegaf'],
            ['F551 20 123', 'Ade Fachrul Hanandua'],
            ['F551 20 124', 'Moh. Rezki Pratama'],
            ['F551 20 125', 'Atira Damayanti']
        ];

        // Data Mahasiswa Sistem Informasi (F521) - Angkatan 2020
        $students_si_20 = [
            ['F521 20 003', 'Ikhsan Wahyudin Hanama'],
            ['F521 20 008', 'Rizaldi Agil Faturrahman'],
            ['F521 20 010', 'Syeikhan Ritzmy Madjid'],
            ['F521 20 019', 'Ismawati Maida'],
            ['F521 20 023', 'Muy. Zuhud'],
            ['F521 20 026', 'Adjie Putra Ramadhan'],
            ['F521 20 030', 'Afridha Iskandar'],
            ['F521 20 032', 'Muamar Farhan'],
            ['F521 20 034', 'Muh. Ilham Reonaldi'],
            ['F521 20 037', 'Didit Faturrahman'],
            ['F521 20 039', 'Moh Jumaidil Arham'],
            ['F521 20 041', 'Widiarmo'],
            ['F521 20 043', 'Rina Kartika'],
            ['F521 20 044', 'I Made Reyvinno Dirga Narke'],
            ['F521 20 050', 'Agung Wahyu Anugrah'],
            ['F521 20 051', 'Andi Idham Putra Mahardi'],
            ['F521 20 052', 'Bulean Kyrie Eleisen'],
            ['F521 20 054', 'Muhammad Syahrial Marasobu'],
            ['F521 20 004', 'Fenita Delia'],
            ['F521 20 005', 'Annisa Putri Febrina'],
            ['F521 20 001', 'Fadiah Suryani Putri'],
            ['F521 20 009', 'Mohamad Irfan'],
            ['F521 20 015', 'Ayub Vigo'],
            ['F521 20 022', 'Rahmadian A. Saada'],
            ['F521 20 027', 'Dhivanny Adhira Putri'],
            ['F521 20 028', 'Alda Nur Pramadinda'],
            ['F521 20 031', 'Moh Fajrin Sigit Aldy'],
            ['F521 20 049', 'Asry Eka Pratama'],
            ['F521 20 016', 'Sahril'],
            ['F521 20 045', 'Mutia'],
            ['F521 20 017', 'Siti Rahmawati']
        ];

        $data = [];
        $now = now();
        $password = Hash::make('password');

        // Helper function untuk proses data
        $processStudents = function($students, $prodi) use ($password, $now) {
            $result = [];
            foreach ($students as $student) {
                // Format NIM: hilangkan spasi (F551 20 021 -> F55120021)
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
                    'tahun_angkatan' => '2020',
                    'qr_data' => (string) Str::uuid(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            return $result;
        };

        // Gabungkan data 2020 (TI & SI)
        $data = array_merge(
            $processStudents($students_ti_20, 'Teknik Informatika'),
            $processStudents($students_si_20, 'Sistem Informasi')
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
        // Hapus data berdasarkan angkatan 2020
        DB::table('users')->where('tahun_angkatan', '2020')->delete();
    }
};
