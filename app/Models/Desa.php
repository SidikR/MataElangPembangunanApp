<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'desa';
    protected $fillable = [
        'id_desa',
        'id_kecamatan',
        'name',
    ];
}
