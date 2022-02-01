<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasAdmin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'id_mk', 'hari', 'jam', 'slot','info'
     ];

}
