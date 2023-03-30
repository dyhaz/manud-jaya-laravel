<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestPerizinan extends Model
{
    protected $fillable = [
        'jenis_id',
        'warga_id',
        'keterangan',
        'lampiran',
        'tanggal_request',
        'status_request'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    protected $table = 'request_perizinan';
    protected $primaryKey = 'request_id';
}
