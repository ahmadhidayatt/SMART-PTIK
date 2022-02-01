<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardAdmin extends Model
{
    use HasFactory;
    protected $table = 'dashboards';
    public $timestamps = true;
    protected $primaryKey = 'id_db';
    protected $fillable = [
        'info'
     ];
}
