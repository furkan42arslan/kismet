<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'type',
        'body',
        'source',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }
}
