<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'company_uuid',
        'salary_from',
        'salary_to',
        'status',
    ];

    /**
     * Auto-generate UUID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * The company that created the job
     */
    public function company()
    {
        return $this->belongsTo(User::class, 'company_uuid', 'uuid');
    }

    /**
     * Applications for this job
     */
    public function applications()
    {
        return $this->hasMany(Applications::class, 'job_uuid', 'uuid');
    }
}
