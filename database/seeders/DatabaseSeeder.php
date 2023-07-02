<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $nama = 'Ninik Mas Ulfa, S.Si., Apt., Sp.FRS.';

        \App\Models\Tujuan::create([
            'nama' => $nama,
            'slug' => Str::slug($nama),
            'telp' => '628121727173'
        ]);
    }
}
