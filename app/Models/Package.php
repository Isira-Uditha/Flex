<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
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
        'discount',
        'package_duration',
        'image_path',
        'created_at',
        'updated_at',
    ];
}
