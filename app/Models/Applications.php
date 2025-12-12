<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Applications extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'job_uuid',
        'candidate_uuid',
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
     * Candidate who applied
     */
    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_uuid', 'uuid');
    }

    /**
     * Job applied to
     */
    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_uuid', 'uuid');
    }


}
