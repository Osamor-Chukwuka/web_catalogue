<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'website_id'];

    // A vote belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A vote belongs to a website.
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
