<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\User;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Str;

   class UserSeeder extends Seeder
   {
       public function run()
       {
           User::create([
               'id' => (string) Str::uuid(),
               'name' => 'Admin User',
               'email' => 'admin@example.com',
               'password' => Hash::make('123'),
               'role' => 'admin',
               'status' => true,
           ]);
       }
   }
   