<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class JenisPerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_perizinan')->insert([
            [
                'nama_perizinan' => 'Surat Keterangan Domisili',
                'deskripsi_perizinan' => 'Surat keterangan domisili digunakan untuk mengkonfirmasi tempat tinggal seseorang'
            ],
            [
                'nama_perizinan' => 'Surat Keterangan Usaha',
                'deskripsi_perizinan' => 'Surat keterangan usaha digunakan untuk mengkonfirmasi keberadaan dan jenis usaha yang dijalankan seseorang'
            ],
            [
                'nama_perizinan' => 'Surat Keterangan Belum Menikah',
                'deskripsi_perizinan' => 'Surat keterangan belum menikah digunakan untuk mengkonfirmasi status pernikahan seseorang'
            ]
        ]);
    }
}
