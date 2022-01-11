<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'like',
        'profilePicPath',
        'color',
        'like'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function texts()
    {
        return $this->belongsToMany(Text::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
