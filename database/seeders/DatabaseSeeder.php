<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 10 user dummy
        User::factory(10)->create();

        // Buat 1 admin manual
        User::create([
            'name' => 'Admin Dummy',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // pastikan kolom ini ada di tabel users
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Masukkan kategori
        DB::table('categories')->insert([
            [
                'category_name' => 'Action',
                'description'   => 'Film dengan adegan-adegan penuh aksi dan ketegangan.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_name' => 'Comedy',
                'description'   => 'Film yang bertujuan untuk menghibur dan mengundang tawa.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_name' => 'Drama',
                'description'   => 'Film yang berfokus pada pengembangan karakter dan konflik emosional.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_name' => 'Sci-Fi',
                'description'   => 'Film dengan latar belakang ilmiah dan teknologi futuristik.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'category_name' => 'Romance',
                'description'   => 'Film yang berpusat pada kisah cinta dan hubungan romantis.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
