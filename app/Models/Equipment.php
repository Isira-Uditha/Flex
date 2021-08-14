<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $primaryKey = 'equipment_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'equipment_code',
        'equipment_name',
        'category',
        'equipment_price',
        'registered_date',
        'muscles_used',
        'status',
        'equipment_desc',
        'image',
        'created_at',
        'updated_at',
    ];
}
