<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Wali Kelas
        User::updateOrCreate(
            ['username' => 'walas8b'],
            [
                'name'     => 'Ilham Nasrian, S.Pd',
                'email'    => 'walas@alkhawarizmi.sch.id',
                'password' => Hash::make('walas123'),
                'role'     => 'walas',
            ]
        );

        // 2. Akun Bendahara
        User::updateOrCreate(
            ['username' => 'bendahara8b'],
            [
                'name'     => 'Bendahara Kelas VIII B',
                'email'    => 'bendahara@alkhawarizmi.sch.id',
                'password' => Hash::make('bendahara123'),
                'role'     => 'bendahara',
            ]
        );
    }
}