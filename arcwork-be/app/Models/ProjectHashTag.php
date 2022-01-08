<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHashTag extends Model
{
    use HasFactory;
    protected $table = 'table_project_hashtag';
    protected $fillable = [
        'projectId',
        'hashtagId'
    ];
}
