<?php

namespace Database\Seeders;

use App\Models\JenisPerizinan;
use App\Models\RequestPerizinan;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestPerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request_perizinan')->insert([
            [
                'tanggal_request' => '2022-01-01',
                'status_request' => 'Menunggu Persetujuan',
                'keterangan' => 'Saya memerlukan surat keterangan domisili untuk keperluan administrasi',
                'jenis_id' => 1,
                'warga_id' => 1
            ],
            [
                'tanggal_request' => '2022-02-02',
                'status_request' => 'Disetujui',
                'keterangan' => 'Saya memerlukan surat keterangan usaha untuk keperluan perpanjangan izin usaha',
                'jenis_id' => 2,
                'warga_id' => 2
            ],
            [
                'tanggal_request' => '2022-03-03',
                'status_request' => 'Ditolak',
                'keterangan' => 'Saya memerlukan surat keterangan belum menikah untuk keperluan beasiswa',
                'jenis_id' => 3,
                'warga_id' => 3
            ]
        ]);

        $statuses = ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'];
        $jenisPerizinan = JenisPerizinan::pluck('jenis_id')->toArray();
        $warga = Warga::pluck('warga_id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            $requestPerizinan = new RequestPerizinan;
            $requestPerizinan->tanggal_request = now()->subDays(rand(1, 30));
            $requestPerizinan->status_request = $statuses[array_rand($statuses)];
            $requestPerizinan->keterangan = 'Perizinan ' . $i;
            $requestPerizinan->jenis_id = $jenisPerizinan[array_rand($jenisPerizinan)];
            $requestPerizinan->warga_id = $warga[array_rand($warga)];
            $requestPerizinan->save();
        }
    }
}
