<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        // Data Mahasiswa Teknik Informatika (F551)
        $students_ti = [
            ['F55123004', 'Marsya Cikita Rara Pratiwi'],
            ['F55123006', 'Suparman'],
            ['F55123007', 'Mahreczy Aditya Putra'],
            ['F55123008', 'Putri Casiola Mokodongan'],
            ['F55123011', 'Zaky Putra Safandra'],
            ['F55123013', 'Windi antika'],
            ['F55123016', 'Natasya labaso'],
            ['F55123026', 'Fransisca Aprilia Tarabu'],
            ['F55123030', 'Briant Juan Hamonangan'],
            ['F55123031', 'Fahril Antonio Hande'],
            ['F55123037', 'Moh Maulana Yahya'],
            ['F55123038', 'Muhammad rafi rabbani'],
            ['F55123042', 'Nur Aisyah'],
            ['F55123048', 'Radityo andrean'],
            ['F55123050', 'Aidil Ramadhan'],
            ['F55123054', 'Syahril Fitrawan Abadi'],
            ['F55123058', 'Muh. Fadhlur Rahman R. Salim'],
            ['F55123059', 'Sifa Sahira'],
            ['F55123060', 'Alfito Leonard'],
            ['F55123061', 'JUAN PABLO PUTRA KUGANDA'],
            ['F55123064', 'Syaif Ali M. Risal'],
            ['F55123065', 'Andi Muhammad Ihzan A.S'],
            ['F55123067', 'Nayla Fatira'],
            ['F55123070', 'Aura Najwa Juliandra'],
            ['F55123071', 'Ariel Adriazul Ahwan'],
            ['F55123072', 'Asfita Saldarisya Nadjun'],
            ['F55123073', 'Hillary Gracia'],
            ['F55123075', 'SRI ASWANTI'],
            ['F55123076', 'Muhammad Rayyan Nazmuddin'],
            ['F55123077', 'Fatur Rahman'],
            ['F55123079', 'Rey Rizky Andifa'],
            ['F55123083', 'Tanwirul Muttaqin'],
            ['F55123087', 'Arya Nanda Putra'],
            ['F55123088', 'RIAN AHMAD'],
            ['F55123089', 'Dede Fauzan'],
            ['F55123090', 'Isti Zahra Eka Putri Katili'],
            ['F55123092', 'Anggita setiawati'],
            ['F55123095', 'Reyhan Dany'],
            ['F55123096', 'Rifaldi'],
            ['F55123099', 'Muh.Fahri Alamsyah'],
            ['F55123001', 'Mohammad Raiyan'],
            ['F55123002', 'Novita Fadilah Datu Amas'],
            ['F55123003', 'Muh. Mashaq Ramadhan. M'],
            ['F55123005', 'Vicram L'],
            ['F55123009', 'Siti nurvatika'],
            ['F55123010', 'Hasby Ashidiq'],
            ['F55123012', 'Muhammad Haliim'],
            ['F55123014', 'Lyra Attallah Aurellia'],
            ['F55123015', 'Octavia Ramadhani'],
            ['F55123017', 'FITRI HANDAYANI'],
            ['F55123018', 'Muhammad Al-Faraby Moidady'],
            ['F55123020', 'Avav Abdillah Sam'],
            ['F55123021', 'Moh Qhiran'],
            ['F55123022', 'Aqilah Nur Aisyah Putri'],
            ['F55123024', 'Fadhil Akmal Zakaria'],
            ['F55123025', 'Yuyun Aulia Afrianty'],
            ['F55123028', 'Dwi Candra Andika'],
            ['F55123032', 'Nakita Semesta'],
            ['F55123033', 'Marvellous Demetrius Mait'],
            ['F55123034', 'Rizka Filardi Toliz'],
            ['F55123035', 'Sofia Qatrunnada'],
            ['F55123039', 'Amirul Maulana Mumba'],
            ['F55123040', 'Moh. Faathir Ash Shaff'],
            ['F55123041', 'RASYA RAHMAT SYABAN'],
            ['F55123043', 'Aura Nayla Djokja'],
            ['F55123044', 'I WAYAN ARIGAYU SAPUTRA'],
            ['F55123046', 'Teguh praditya'],
            ['F55123047', 'Hajera'],
            ['F55123049', 'Yunus Syahrul Mubarok'],
            ['F55123051', 'JESSICA ANDRYANI'],
            ['F55123052', 'MUH. ZULHAJIR. AR'],
            ['F55123053', 'Horas Imanuel Siregar'],
            ['F55123055', 'Muhammad Alif Risaldy'],
            ['F55123056', 'Bagus pria utama'],
            ['F55123057', 'Rut Naomi Ester Sitompul'],
            ['F55123062', 'Ahmad Mujahid'],
            ['F55123066', 'Imam Agil Aiman'],
            ['F55123068', 'Aulia Fitri Hanifah'],
            ['F55123069', 'ANUGRAH AHMAD WIRANTO'],
            ['F55123082', 'Muhammad Ali Mubaraq'],
            ['F55123084', 'Angelina Febriani Madesen'],
            ['F55123085', 'Moh. Al-Faiz'],
            ['F55123091', 'Muhammad Rifky'],
            ['F55123094', 'Andi Muhammad Fayyadh'],
            ['F55123098', 'Cindy Amelia']
        ];

        // Data Mahasiswa Sistem Informasi (F521)
        $students_si = [
            ['F52123003', 'CAHYA NABILA MANNASSAI'],
            ['F52123004', 'Desak Damayanti'],
            ['F52123005', 'Nur Istiqama'],
            ['F52123007', 'ASTIAWATI MANDA'],
            ['F52123008', 'Armita Samrin'],
            ['F52123009', 'Fitriyani Nurkholis'],
            ['F52123011', 'NISMA'],
            ['F52123012', 'Gilang Aldiansyah'],
            ['F52123016', 'Salsabila ramadhani zen'],
            ['F52123017', 'Zharnativa Al Adiyah Nurba'],
            ['F52123018', 'Yuninda Kristina lawani'],
            ['F52123020', 'Nur Khalizah'],
            ['F52123024', 'Khaifalia Meiladysetia Elegan'],
            ['F52123025', 'Viska Inela'],
            ['F52123027', 'ADITYA ZALDY'],
            ['F52123028', 'SAPTO MART SAPUTRA WICAKSONO'],
            ['F52123031', 'Yeni Kristina Wati Lapono'],
            ['F52123032', 'RICHARD VALENTINO PARULIAN SILALAHI'],
            ['F52123033', 'MOH. ARIF RAHMAN PRATAMA'],
            ['F52123034', 'Reihan Abta Afghani'],
            ['F52123036', 'Muthia Rizka. Y. Inga'],
            ['F52123040', 'ANUGERAH FITADEWI'],
            ['F52123041', 'Aura Putri Rahmania'],
            ['F52123042', 'Fitrah Azizah A. Datu'],
            ['F52123045', 'Eka Putri Yana'],
            ['F52123046', 'Meysie Nawita Gerarda Tampu'],
            ['F52123047', 'Asma lutfi'],
            ['F52123049', 'Andi Putri Vaneisya'],
            ['F52123053', 'Annisa Diandra Wahani'],
            ['F52123054', 'Aura Ghina Mandary'],
            ['F52123057', 'Misbahuddin'],
            ['F52123059', 'Khaerul huda s'],
            ['F52123060', 'DIAN WULANDARI'],
            ['F52123061', 'Aura Rahmadani'],
            ['F52123062', 'Yuda Ramanda Putra'],
            ['F52123065', 'Andika Putra'],
            ['F52123066', 'Fathul Mubarak'],
            ['F52123068', 'Fauzan Asri'],
            ['F52123069', 'Moh.Rasyid Siddiq'],
            ['F52123070', 'SITTI CAHYA RAMADANI'],
            ['F52123071', 'Nadhia Putri Aprhilia'],
            ['F52123074', 'Nurul Zaskia'],
            ['F52123075', 'Adriani Maulidya'],
            ['F52123076', 'Muhammad khaechal fadillah yusuf'],
            ['F52123077', 'Fachriadi'],
            ['F52123078', 'Dinar Fauziah'],
            ['F52123079', 'ARYA YUDHISTIRA SYAFRUL'],
            ['F52123080', 'MUHAMMAD ABDILLAH FATTAH'],
            ['F52123084', 'Andini Artika Ridwan'],
            ['F52123088', 'Sakia Riandita Putri'],
            ['F52123091', 'ABDURRAHMAN ZAIDIL HAQ'],
            ['F52123092', 'Joshua Riman Kape'],
            ['F52123093', 'Uswatun Hasanah Hidayatul Natalia'],
            ['F52123094', 'RIFKY HARUN'],
            ['F52123095', 'Muh. Yusuf'],
            ['F52123096', 'Ratu Ramadhani Rapele'],
            ['F52123097', 'Rafika Nur Indriani'],
            ['F52123099', 'Kadek surya adi dwi putra'],
            ['F52123001', 'LILA VIMALA'],
            ['F52123014', 'Amelia Wulandari H. Geni'],
            ['F52123015', 'Syavira Humayra'],
            ['F52123023', 'Moh. Daffa Al Hafidz J. Moonti'],
            ['F52123039', 'Mohammad Algifari Ramadhan'],
            ['F52123043', 'Andi Syahkty Alifah Assalam'],
            ['F52123048', 'Felicia Claudia Pandelaki'],
            ['F52123052', 'Sofia Ismar Hermansyah'],
            ['F52123056', 'Julius Caesar Fransisco Pieters'],
            ['F52123058', 'Dede Al Fandi'],
            ['F52123067', 'syahira kayla humayra'],
            ['F52123072', 'La Ode Mualim Khalifah Khair'],
            ['F52123083', 'Safana Annisa Salsabilah'],
            ['F52123089', 'Muh Azhar Rasyid']
        ];

        $data = [];
        $now = now();
        $password = Hash::make('password'); // Password default

        // Helper function untuk proses data
        $processStudents = function($students, $prodi) use ($password, $now) {
            $result = [];
            foreach ($students as $student) {
                // Format NIM: hilangkan spasi
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
                    'tahun_angkatan' => '2023',
                    'qr_data' => (string) Str::uuid(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            return $result;
        };

        // Gabungkan data
        $data = array_merge(
            $processStudents($students_ti, 'Teknik Informatika'),
            $processStudents($students_si, 'Sistem Informasi')
        );

        // Insert data satu per satu dengan pengecekan unique constraint (PostgreSQL Upsert)
        // Ini akan mengupdate data jika NIM sudah ada, atau insert jika belum.
        DB::table('users')->upsert(
            $data,
            ['nim'], // Kolom unik yang dicek (constraint unique di tabel users biasanya pada 'email' atau 'nim')
            ['name', 'prodi', 'updated_at'] // Kolom yang diupdate jika duplikat ditemukan
        );
        
        // CATATAN: Jika database Anda bukan PostgreSQL/MySQL terbaru yang dukung upsert,
        // gunakan loop + updateOrInsert sebagai alternatif:
        /*
        foreach ($data as $user) {
            DB::table('users')->updateOrInsert(
                ['nim' => $user['nim']], // Kunci pencarian
                $user // Data yang diupdate/insert
            );
        }
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus data berdasarkan angkatan 2023
        DB::table('users')->where('tahun_angkatan', '2023')->delete();
    }
};
