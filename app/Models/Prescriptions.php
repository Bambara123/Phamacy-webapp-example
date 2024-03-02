<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(Images::class, 'prescription_id');
    }

    protected $fillable = [
        'note',
        'address',
        'user_id',

    ];
}
