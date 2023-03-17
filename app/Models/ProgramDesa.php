<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDesa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_program',
        'deskripsi_program',
        'tanggal_mulai',
        'tanggal_selesai',
        'desa_id',
        'anggaran',
        'foto'
    ];

    protected $table = 'program_desa';
    protected $primaryKey = 'program_id';

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'desa_id');
    }

    public function pelaksanaPrograms()
    {
        return $this->hasMany(PelaksanaProgram::class, 'program_id', 'program_id');
    }
}
