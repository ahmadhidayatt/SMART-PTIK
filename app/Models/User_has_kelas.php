<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_kelas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_has_kelas';
    
    protected $fillable = [
        'id_user', 'id_kelas', 'jam', 'slot'
     ];
}
