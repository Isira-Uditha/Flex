<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'payment_date',
        'uid',
        'package_id',
    ];
}
