<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'rfid',
        'address',
        'telephone',
        'class_id',
        'user_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class); // model kelas, misal "Classroom"
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
