<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Desa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'jumlah_penduduk'
    ];

    protected $table = 'desa';
    protected $primaryKey = 'desa_id';
    // rest of the model code
}
