<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'menu_code',
    'name',
    'price',
    'quantity',
    'notes',
    ];

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}