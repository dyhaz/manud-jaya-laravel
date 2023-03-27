<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warga')->insert([
            [
                'nama_warga' => 'Roni Rujak',
                'alamat' => 'Jalan Jendral Sudirman No.1',
                'nomor_telepon' => '08123456789',
                'email' => 'johndoe@gmail.com',
                'nik' => '1234567890123456'
            ],
            [
                'nama_warga' => 'Fifi Fried Chicken',
                'alamat' => 'Jalan Gatot Subroto No.2',
                'nomor_telepon' => '08123456788',
                'email' => 'janedoe@gmail.com',
                'nik' => '1234567890123457'
            ],
            [
                'nama_warga' => 'Neni Nasgor',
                'alamat' => 'Jalan HR Rasuna Said No.3',
                'nomor_telepon' => '08123456787',
                'email' => 'bobsmith@gmail.com',
                'nik' => '1234567890123458'
            ]
        ]);
    }
}
