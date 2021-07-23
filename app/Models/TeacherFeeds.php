<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherFeeds extends Model{
    use HasFactory;

    protected $table = 'teacher_newsfeed';
    protected $fillable = [ 'teacher_id', 'feed_title', 'feed_body' ];
}
