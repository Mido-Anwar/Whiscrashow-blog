<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Mido',
            'email' => 'mimianwar33@hotmail.com',
            'password' => Hash::make('4688aqaqaq4688'),
        ]);
        $user->assignRole('Admin');
    }
}
