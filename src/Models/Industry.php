<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Industry extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    
    protected $table = 'industries';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'industry_id', 'id');
    }
}
