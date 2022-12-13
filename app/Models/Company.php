<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'company';

    public function comments(): HasMany
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }
}
