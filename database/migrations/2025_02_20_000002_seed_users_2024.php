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
        // Data Mahasiswa Teknik Informatika (F551) - Angkatan 2024
        $students_ti_24 = [
            ['F55124001', 'MOHAMAD JIMMY MELANDRY'],
            ['F55124002', 'RAFLI FAUZI'],
            ['F55124003', 'NENENG EKA ARYA KOMALA'],
            ['F55124004', 'RAY JULIANO SAERANG'],
            ['F55124005', 'ANISA AULIA FEBRINA A YUNDA'],
            ['F55124006', 'RYADI HAMDANI'],
            ['F55124007', 'FAUZHIRA DWI SEPTIANA'],
            ['F55124009', 'FADIL WIRAWAN HI ARDIN'],
            ['F55124010', 'AMALIA AZ ZAHRAH'],
            ['F55124011', 'ALIFA NURSINTIA MARSYA'],
            ['F55124012', 'MOH. ARIEF PRASETYO'],
            ['F55124013', 'FADHILAH AZZAHRA'],
            ['F55124014', 'MUHAMMAD AQIL FATHURRAHMAN'],
            ['F55124015', 'ARDIANSYAH N. UMAR'],
            ['F55124016', 'AHDAYANI DWI PUTRI SALAM'],
            ['F55124017', 'MADE BAGAS MARDIANA'],
            ['F55124018', 'HAERUL ILMAN'],
            ['F55124019', 'CHATRIN AURELIA'],
            ['F55124020', 'MUHAMMAD RIZKI'],
            ['F55124022', 'DIRLI DWI PUTRA'],
            ['F55124024', 'ISMI FADILAH'],
            ['F55124025', 'ACHMAD AULIA IRSYAD'],
            ['F55124026', 'RAIHAN S. ATUKA'],
            ['F55124027', 'MUH. APRIAWAN'],
            ['F55124028', 'ATALYA VICTORIA DOMINIQUE KUPAGAN'],
            ['F55124029', 'FIQHY FAUZAN'],
            ['F55124030', 'SIFA ZIKRIANI'],
            ['F55124031', 'FATAN MOHAMMAD'],
            ['F55124032', 'GINA MASITA'],
            ['F55124033', 'NADIA'],
            ['F55124036', 'ABUBAKAR SHIDDIQ'],
            ['F55124037', 'ELIKA KHARDALIA'],
            ['F55124038', 'ALIF APRIANSYAH'],
            ['F55124039', 'ZAHRA'],
            ['F55124040', 'IDHAM HALID'],
            ['F55124041', 'HADID HIDAYAH'],
            ['F55124044', 'SALSABILA'],
            ['F55124045', 'MOH. REZA'],
            ['F55124046', 'AUL ZIKRI'],
            ['F55124050', 'MOH. SYAHRUL R. UMAR'],
            ['F55124051', 'MUHAMMAD ADZAN PUTRA PRATAMA'],
            ['F55124053', 'KARYN FEBRINA SESA'],
            ['F55124054', 'JAHES HAIKAL PAPIA'],
            ['F55124055', 'DIMAS REGINALD BHAMAKERTI'],
            ['F55124058', 'ALFIN PRATAMA MONSANGI'],
            ['F55124059', 'FACHRI ALFANSYAH'],
            ['F55124060', 'DEDDY MISWAR'],
            ['F55124061', 'ADNAN MUFTI MAULANA'],
            ['F55124063', 'WANDA REMALIA TORIPALU'],
            ['F55124066', 'CRISTIAN MARSEL KASIO'],
            ['F55124067', 'LATIFAH PUTRI FAKHRUDDIN'],
            ['F55124071', 'AURALIA ZALSABILLAH'],
            ['F55124073', 'TRIYANTI AULIA'],
            ['F55124076', 'GABRIEL KRISTOFAN SUPARI'],
            ['F55124079', 'MOH. NABIL SYAPUTRA'],
            ['F55124081', 'HADYNATA YUSUF PRATAMA'],
            ['F55124082', 'DIMAS SETIAWAN'],
            ['F55124084', 'SAHIRUDDIN'],
            ['F55124085', 'MOHAMMAD REZA DWI SYAHPUTRA'],
            ['F55124087', 'I MADE ADITYA PRAMANA'],
            ['F55124088', 'MELIN OKTAFIANI'],
            ['F55124090', 'MUHAMMAD NAUFAL AMAR'],
            ['F55124093', 'ABDUL HAIKAL'],
            ['F55124094', 'ANDI BESSE OPU TENRI SOMPA'],
            ['F55124096', 'IRPANDI'],
            ['F55124097', 'ANDI FAATHIR MUHAMMAD I.B SAMAD'],
            ['F55124101', 'MOH AFADIL AGIS PRATAMA'],
            ['F55124103', 'MOH. PASYA CAKRA WANGSA'],
            ['F55124104', 'MOH MAGRIBI RAMADHAN'],
            ['F55124106', 'MOH HAIKAL BUTUDOKA'],
            ['F55124113', 'DINI ZAHRA'],
            ['F55124114', 'MIA ISLAMIA'],
            ['F55124115', 'RAMON PASUNGKE'],
            ['F55124116', 'CLAUDYA CHRISTY KOLOAY']
        ];

        // Data Mahasiswa Sistem Informasi (F521) - Angkatan 2024
        $students_si_24 = [
            ['F52124001', 'CHINDY AMELIA FEBRIANA'],
            ['F52124002', 'AHMAD JAYADI'],
            ['F52124004', 'Yulianingsih'],
            ['F52124005', 'Samuel Hizkia Kuandu'],
            ['F52124006', 'ELSYA ARMELYA NAYSILA HAWANE'],
            ['F52124007', 'ABID ARI'],
            ['F52124008', 'SINDI VATIKA SARI'],
            ['F52124009', 'Laela Tummusfiroh'],
            ['F52124010', 'RAYHAN ALIFFINSI DOTUTINGGI'],
            ['F52124011', 'Alya Nadira'],
            ['F52124012', 'Istianur Khalija'],
            ['F52124013', 'MOH. IKHSAN'],
            ['F52124014', 'AULIA KAMELIA'],
            ['F52124015', 'LARA FAUZIA'],
            ['F52124016', 'Herdiawan Timpo'],
            ['F52124017', 'NUR AMELIA'],
            ['F52124018', 'Putri Ramadani Ma\'ruf'],
            ['F52124019', 'Najwa Ayu Sabilah'],
            ['F52124021', 'MARCHELLA SILVIANA MICHELLE MARUNDUH'],
            ['F52124022', 'RATU ANNISA'],
            ['F52124023', 'GAIDA MUTHMAINNAH'],
            ['F52124024', 'Nur Ainun'],
            ['F52124025', 'Riska Ayudia'],
            ['F52124026', 'NUR AULIA SAFITRI'],
            ['F52124028', 'Nadila'],
            ['F52124029', 'NABIL MUJAHID RAJA'],
            ['F52124030', 'Gloria Tanelova Mapada'],
            ['F52124031', 'NILUH ELSA CANTIKA'],
            ['F52124033', 'Syalwa Alya'],
            ['F52124034', 'PUTRI INTAN AYUNINGTYAS'],
            ['F52124035', 'Zahra'],
            ['F52124036', 'VANISSA AZZAHRA NGGIU'],
            ['F52124038', 'ASTRID WULANDARI F AHMAD'],
            ['F52124039', 'Reyqal Syawalano Enka Widodo'],
            ['F52124040', 'ZAHWA FINI FATIYAH'],
            ['F52124041', 'Mega Saputri'],
            ['F52124042', 'SAHRA ANSAR'],
            ['F52124043', 'Yuli Yanti'],
            ['F52124044', 'FEBRIANSYAH H.'],
            ['F52124045', 'Soleha'],
            ['F52124046', 'AISYA U. TONDU'],
            ['F52124047', 'Siti Syakirah R. Laridja'],
            ['F52124048', 'MOH. SYAHRIL A. KADILI'],
            ['F52124049', 'Elen Tri Alfiana Salua'],
            ['F52124050', 'MUH IKHRAM'],
            ['F52124051', 'Ni Komang Ayu Ratih Asrati'],
            ['F52124052', 'Moh. Fauzi Ramadhan'],
            ['F52124059', 'Marchelinda Bin'],
            ['F52124061', 'CITRA RAMADHANI'],
            ['F52124063', 'Ni Ketut Maylinda Safira'],
            ['F52124064', 'MOH. ANDHIKA DINATA'],
            ['F52124066', 'ELSA RISMA'],
            ['F52124068', 'MOH ANDRI RISKY'],
            ['F52124070', 'Anggun Salsabila'],
            ['F52124072', 'FILTATRA'],
            ['F52124073', 'MUH DAWAI'],
            ['F52124075', 'Silfiani Hasanah'],
            ['F52124077', 'Wahyuddin'],
            ['F52124078', 'Rendi Saputra Tolambu'],
            ['F52124081', 'Rian Hidayat'],
            ['F52124082', 'Aulia Ramadhani Asri'],
            ['F52124084', 'Syifa juliasary halimu'],
            ['F52124085', 'NUR HAFSA'],
            ['F52124086', 'NARSYAH FITRI AMALIA M. TOIGA'],
            ['F52124087', 'Sa\'adah Ramadhan'],
            ['F52124088', 'Kethlien'],
            ['F52124089', 'MUH IQBAL'],
            ['F52124090', 'AMMINIA'],
            ['F52124091', 'SHENDY PUTRA SILOAM KALAMBE'],
            ['F52124095', 'MOH WAHYU A DAY'],
            ['F52124096', 'IFDAL M WAJIB'],
            ['F52124097', 'Alya Shafa'],
            ['F52124098', 'ALYA FADYA PUTRI MADO']
        ];

        $data = [];
        $now = now();
        $password = Hash::make('password');

        // Helper function untuk proses data
        $processStudents = function($students, $prodi) use ($password, $now) {
            $result = [];
            foreach ($students as $student) {
                // Format NIM: hilangkan spasi jika ada
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
                    'tahun_angkatan' => '2024',
                    'qr_data' => (string) Str::uuid(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            return $result;
        };

        // Gabungkan data 2024 (TI & SI)
        $data = array_merge(
            $processStudents($students_ti_24, 'Teknik Informatika'),
            $processStudents($students_si_24, 'Sistem Informasi')
        );

        // Insert data satu per satu dengan pengecekan unique constraint (PostgreSQL Upsert)
        // Ini akan mengupdate data jika NIM sudah ada, atau insert jika belum.
        DB::table('users')->upsert(
            $data,
            ['nim'], // Kolom unik yang dicek
            ['name', 'prodi', 'tahun_angkatan', 'updated_at'] // Kolom yang diupdate jika duplikat ditemukan
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus data berdasarkan angkatan 2024
        DB::table('users')->where('tahun_angkatan', '2024')->delete();
    }
};