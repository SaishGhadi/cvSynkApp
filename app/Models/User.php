<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'role',
        'address',
        'skills',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array', // JSON cast
    ];

    /**
     * Auto-generate UUID on model create.
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
     * Company has many jobs.
     */
    public function jobs()
    {
        return $this->hasMany(Jobs::class, 'company_uuid', 'uuid');
    }

    /**
     * Candidate has many applications.
     */
    public function applications()
    {
        return $this->hasMany(Applications::class, 'candidate_uuid', 'uuid');
    }

    /**
     * Role helpers
     */
    public function isCompany()
    {
        return $this->role === 'company';
    }

    public function isCandidate()
    {
        return $this->role === 'candidate';
    }
}
