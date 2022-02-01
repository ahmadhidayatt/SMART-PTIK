<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $primaryKey = 'id_absen';
    public $timestamps = true;
    protected $fillable = [
        'id_kelas', 'tanggal', 'status','jam'
     ];
}
