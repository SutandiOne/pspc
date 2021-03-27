<?php

namespace Database\Seeders;

use App\Models\Ppc;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PPCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'ppc',
            'email' => 'ppc@sscworks.com',
            'password' => Hash::make('ppc123'),
            'role' => 'ppc'
        ]);

        Ppc::create([
            'user_id' => $user->id,
            'nama' => 'Park',
            'tanggal_lahir' => '1997-10-02',
            'no_hp' => '092172171883',
            'alamat' => 'park one',
            'gender' => 'L'
        ]);
    }
}
