<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mkuliah extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_mk';
    protected $fillable = [
        'matkul', 'id_dosen', 'hari', 'jam', 'slot'
     ];

}
