<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $primaryKey = 'desa_id';
    // rest of the model code
}
