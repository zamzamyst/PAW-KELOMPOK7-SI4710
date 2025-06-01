<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'rating',
        'comment',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
