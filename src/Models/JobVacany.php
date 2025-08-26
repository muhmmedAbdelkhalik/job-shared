<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobVacany extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'job_vacancies';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'type',
        'company_id',
        'category_id',
        'view_count',
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id', 'id');
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_vacancy_id', 'id');
    }
}
