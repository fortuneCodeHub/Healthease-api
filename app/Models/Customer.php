<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "age",
        "weight",
        "height",
        "allergies",
        "health_issues",
        "genotype",
        "blood_group",
        "user_lang",
        "postal_code",
        "plan",
        "plan_exp",
    ];

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
