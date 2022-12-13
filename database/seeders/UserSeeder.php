<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'masteradmin',
            'email' => 'masteradmin@asta.co.id',
            'activated_at' => date('2022-01-01'),
            'password' => bcrypt('adminDapatKerja'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Asta Nadi Karya Utama',
            'username' => 'anaku2022',
            'email' => 'info@asta.co.id',
            'activated_at' => date('2022-06-06'),
            'password' => bcrypt('companyDapatKerja'),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'name' => 'Damasius Wikaryana',
            'username' => 'user1',
            'email' => 'user@asta.co.id',
            'activated_at' => date('2022-01-01'),
            'password' => bcrypt('userDapatKerja'),
        ]);

        $user->assignRole('user');
    }
}
