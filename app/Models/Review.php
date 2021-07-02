<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'anonymous' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'review_id');
    }
    public function rating(): float
    {
        return $this->ratings->avg('positive');
    }
    public function getRatingAttribute(): float
    {
        return $this->rating();
    }
}
