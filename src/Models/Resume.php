<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'resumes';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'file_name',
        'file_url',
        'contact_details',
        'education',
        'summary',
        'skills',
        'experience',
        'user_id',
    ];

    protected $casts = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'resume_id', 'id');
    }
}
