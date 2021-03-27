<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                [
                    'username' => 'SuperAdmin',
                    'email' => 'superadmin@sscworks.com',
                    'password' => Hash::make('superadmin123'),
                    'role' => 'admin'
                ],[
                    'username' => 'AdminPPC',
                    'email' => 'adminppc@sscworks.com',
                    'password' => Hash::make('ppc123'),
                    'role' => 'admin'
                ],[
                    'username' => 'Manager',
                    'email' => 'manager@sscworks.com',
                    'password' => Hash::make('manager123'),
                    'role' => 'manager'
                ]
            ]
        );
    }
}
