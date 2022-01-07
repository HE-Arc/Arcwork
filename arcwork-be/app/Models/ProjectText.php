<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectText extends Model
{
    use HasFactory;
    protected $table = 'table_project_text';
    protected $fillable = [
        'projectId',
        'textId'
    ];
}
