<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $daftarSiswa = [
            ['nis' => '1479', 'nama' => 'Abiyyu Akhtar Faiz', 'jenis_kelamin' => 'L'],
            ['nis' => '1483', 'nama' => 'Airin Ramadhani', 'jenis_kelamin' => 'P'],
            ['nis' => '1485', 'nama' => 'Alana Delisha Raniah', 'jenis_kelamin' => 'P'],
            ['nis' => '1486', 'nama' => 'Alby Fachry Sintarya', 'jenis_kelamin' => 'L'],
            ['nis' => '1487', 'nama' => 'Alif Pratama Huna', 'jenis_kelamin' => 'L'],
            ['nis' => '1488', 'nama' => 'Alifa Ufairah Sovy', 'jenis_kelamin' => 'P'],
            ['nis' => '1492', 'nama' => 'Anindya Thalita Widiyanto', 'jenis_kelamin' => 'P'],
            ['nis' => '1498', 'nama' => 'Cheeryl Adeeva', 'jenis_kelamin' => 'P'],
            ['nis' => '1499', 'nama' => 'Cinta Putri Aypal', 'jenis_kelamin' => 'P'],
            ['nis' => '1502', 'nama' => 'Dinda Naura Amanah', 'jenis_kelamin' => 'P'],
            ['nis' => '1504', 'nama' => 'Fairuz Albar Habibi', 'jenis_kelamin' => 'L'],
            ['nis' => '1505', 'nama' => 'Falisha Indarabbihi', 'jenis_kelamin' => 'P'],
            ['nis' => '1506', 'nama' => 'Falisha Jovita Ghassani', 'jenis_kelamin' => 'P'],
            ['nis' => '1512', 'nama' => 'Keisha Shaqile Maritza', 'jenis_kelamin' => 'P'],
            ['nis' => '1517', 'nama' => 'Muhammad Ahza Danish', 'jenis_kelamin' => 'L'],
            ['nis' => '1518', 'nama' => 'M. Fadhlan Syahreza', 'jenis_kelamin' => 'L'],
            ['nis' => '1522', 'nama' => 'Muhammad Azfar Rahman', 'jenis_kelamin' => 'L'],
            ['nis' => '1525', 'nama' => 'Muhammad Sultan Dwi Finsa', 'jenis_kelamin' => 'L'],
            ['nis' => '1529', 'nama' => 'Nayla Firqah Najiah', 'jenis_kelamin' => 'P'],
            ['nis' => '1532', 'nama' => 'Qaireen Afiqah Rizki', 'jenis_kelamin' => 'P'],
            ['nis' => '1535', 'nama' => 'Raga Diandra Sapta Aldavie', 'jenis_kelamin' => 'L'],
            ['nis' => '1536', 'nama' => 'Raisyah Afiqa Dean', 'jenis_kelamin' => 'P'],
            ['nis' => '1541', 'nama' => 'Shara Bilqis El-Tsaniyah Khalik', 'jenis_kelamin' => 'P'],
            ['nis' => '1546', 'nama' => 'Zivanna Syakira Sandrona', 'jenis_kelamin' => 'P'],
        ];

        foreach ($daftarSiswa as $siswa) {
            Student::updateOrCreate(
                ['nis' => $siswa['nis']],
                $siswa
            );
        }
    }
}