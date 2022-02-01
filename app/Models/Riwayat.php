<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'riwayats';
    protected $primaryKey = 'id_riwayat';
    protected $fillable = [
        'id_absenMk', 'status'
     ];
}
