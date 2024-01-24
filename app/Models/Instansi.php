<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instansi extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'instansi';
    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'deskripsi',
    ];
}
