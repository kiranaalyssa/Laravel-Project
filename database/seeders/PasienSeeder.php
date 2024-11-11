<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i < 10; $i++){
            Pasien::create([
                'no_rekam_medis' => 'RM' . str_pad($i + 1, 4, '0', STR_PAD_LEFT), 
                'nama_pasien'=> $faker->name,
                'nik' => $faker->numerify('##################'),
                'alamat' => $faker->address, 
                'jumlah_kunjungan' => 0,
            ]);
        }
    }
}
