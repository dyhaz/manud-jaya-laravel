<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LandingPage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo_image',
        'title',
        'subtitle',
        'visi',
        'misi',
        'about_manud_jaya'
    ];

    protected $table = 'landing_page';
    protected $primaryKey = 'id';
    // rest of the model code
}
