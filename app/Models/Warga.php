<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'nik',
        'nama_warga',
        'nomor_telepon',
        'alamat',
        'email'
    ];

    public function requestPerizinan()
    {
        return $this->hasMany(RequestPerizinan::class);
    }
}
