<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'job_applications';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'status',
        'ai_score',
        'ai_feedback',
        'user_id',
        'resume_id',
        'job_vacancy_id',
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

    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function resume()
    {
        return $this->belongsTo(Resume::class, 'resume_id', 'id');
    }
    public function jobVacancy()
    {
        return $this->belongsTo(JobVacany::class, 'job_vacancy_id', 'id');
    }

}
