<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    use HasFactory, HasUuids;

    protected $table = 'balance';
    
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'total',
    ];
}
