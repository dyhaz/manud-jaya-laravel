<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPerizinan extends Model
{
    protected $fillable = [
        'nama_perizinan',
        'deskripsi_perizinan'
    ];

    protected $table = 'jenis_perizinan';
    protected $primaryKey = 'jenis_id';
}
