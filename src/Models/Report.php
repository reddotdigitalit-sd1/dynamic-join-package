<?php

namespace RedDotDigitalIT\DynamicJoin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'view', 'users'];

    protected $casts = [
        'view' => 'array',
        'users' => 'array',
    ];
}