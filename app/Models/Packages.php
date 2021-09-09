<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $table = 'package';
    protected $primaryKey = 'package_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'package_name',
        'package_description',
        'package_price',
        'package_duration',
        'created_at',
        'updated_at',
    ];
}
