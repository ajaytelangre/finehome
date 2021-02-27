<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_type extends Model
{
    use HasFactory;
    protected $table = 'services_type';
    protected $fillable = [
        '*'
    ];
    public $timestamps = false;
}
