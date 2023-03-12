<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksanaProgram extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pelaksana',
        'jabatan',
        'kontak',
        'program_id'
    ];

    protected $table = 'pelaksana_program';
    protected $primaryKey = 'pelaksana_id';

    public function programDesa()
    {
        return $this->belongsTo(ProgramDesa::class, 'program_id', 'program_id');
    }
}
