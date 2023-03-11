<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDesa extends Model
{
    use HasFactory;

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
