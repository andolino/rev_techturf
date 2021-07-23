<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherFeedsAttachments extends Model{
    use HasFactory;

    protected $table = 'teacher_newsfeed_attachments';
    protected $fillable = [ 'teacher_newsfeed_id', 'file' ];
}
