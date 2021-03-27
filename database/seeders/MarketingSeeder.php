<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Marketing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'Mark',
            'email' => 'marketing@sscworks.com',
            'password' => Hash::make('mark123'),
            'role' => 'marketing'
        ]);

        Marketing::create([
            'user_id' => $user->id,
            'nama' => 'Mark',
            'tanggal_lahir' => '1997-10-02',
            'no_hp' => '092172171883',
            'alamat' => 'mark one',
            'gender' => 'L'
        ]);

        
    }
}
