<?php

namespace Database\Seeders;

use App\Models\JenisProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'nama' => 'Program Pembangunan Infrastruktur Desa',
                'deskripsi' => 'Program untuk membangun infrastruktur desa seperti jalan, jembatan, irigasi, dan sumber air bersih.'
            ],
            [
                'nama' => 'Program Pemberdayaan Masyarakat Desa',
                'deskripsi' => 'Program untuk memberdayakan masyarakat desa melalui pelatihan keterampilan, pengembangan usaha kecil dan menengah, dan penyuluhan kesehatan.'
            ],
            [
                'nama' => 'Program Peningkatan Kualitas Pendidikan',
                'deskripsi' => 'Program untuk meningkatkan kualitas pendidikan di desa melalui pengadaan fasilitas dan sarana pendidikan, beasiswa, dan pelatihan guru.'
            ],
            [
                'nama' => 'Program Peningkatan Kualitas Kesehatan',
                'deskripsi' => 'Program untuk meningkatkan kualitas kesehatan masyarakat desa melalui penyediaan fasilitas kesehatan dan obat-obatan, penyuluhan kesehatan, dan pemberian vaksin.'
            ],
            [
                'nama' => 'Program Pengembangan Pariwisata Desa',
                'deskripsi' => 'Program untuk mengembangkan pariwisata di desa melalui pengembangan destinasi wisata, promosi pariwisata, dan pelatihan industri pariwisata.'
            ],
            [
                'nama' => 'Program Peningkatan Kualitas Lingkungan',
                'deskripsi' => 'Program untuk meningkatkan kualitas lingkungan di desa melalui pengelolaan sampah, penghijauan, dan pengelolaan air bersih.'
            ],
            [
                'nama' => 'Program Peningkatan Kualitas Pemerintahan Desa',
                'deskripsi' => 'Program untuk meningkatkan kualitas pemerintahan desa melalui peningkatan kinerja birokrasi, transparansi dan akuntabilitas keuangan, dan pengembangan sistem informasi desa.'
            ],
        ];

        foreach ($programs as $program) {
            JenisProgram::create($program);
        }
    }
}
