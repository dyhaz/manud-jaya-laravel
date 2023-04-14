<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriPerizinan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'request_id',
        'user_id',
        'email',
        'status_request',
        'deskripsi'
    ];

    protected $table = 'histori_perizinan';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function perizinan()
    {
        return $this->belongsTo(RequestPerizinan::class, 'request_id', 'request_id');
    }
}
