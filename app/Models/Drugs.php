<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drugs extends Model
{
    use HasFactory;


    protected $fillable = [
        'drug_name',
        'amount',
        'total_price',



    ];
}
