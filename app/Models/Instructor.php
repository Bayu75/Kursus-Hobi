<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'profile_picture', 'bio', 'expertise'])]
class Instructor extends Model
{
    use HasFactory;

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
