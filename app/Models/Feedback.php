<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'order_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedRatingAttribute()
    {
        return $this->rating . ' / 5';
    }

    public function getFormattedCommentAttribute()
    {
        return $this->comment ? nl2br(e($this->comment)) : 'Tidak ada komentar tersedia :(';
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d M Y, H:i');
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at->format('d M Y, H:i');
    }
}
