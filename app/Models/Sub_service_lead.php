<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_service_lead extends Model
{
    use HasFactory;
    protected $fillable = [
        '*'
    ];

    public $timestamps = false;
}
