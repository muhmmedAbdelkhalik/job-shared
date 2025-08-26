<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Company extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'companies';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'address',
        'industry_id',
        'website',
        'owner_id',
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }

    public function jobVacancies()
    {
        return $this->hasMany(JobVacany::class, 'company_id', 'id');
    }

    public function jobApplications()
    {
        return $this->hasManyThrough(JobApplication::class, JobVacany::class, 'company_id', 'job_vacancy_id', 'id', 'id');
    }
}
