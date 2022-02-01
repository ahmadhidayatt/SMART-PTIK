<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiMhs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'absensiMhs';
    protected $primaryKey = 'id_absenMk';
    protected $fillable = [
        'id_absen', 'id_user', 'jam','file','kehadiran','sign'
     ];
}
