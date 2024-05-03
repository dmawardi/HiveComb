<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Project extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $casts = [
        'completion_date' => 'date', // Ensures that completion_date is treated as a Carbon instance
    ];
}
