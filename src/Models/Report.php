<?php

namespace RedDotDigitalIT\DynamicJoin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'report_details', 'users'];

    protected $casts = [
        'report_details' => 'array',
        'users' => 'array',
    ];
}
