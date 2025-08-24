<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = 'job_applications';

    protected $fillable = [
        'title',
        'company',
        'link',
        'status',
        'notes',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
