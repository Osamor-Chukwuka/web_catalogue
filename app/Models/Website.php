<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title', 'description'];

    // Defines the relationship to the Category Model: A website can belong to multiple categories.
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_website');
    }

    // Define the relationship to the Votes model. A website can have multiple votes.
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
