<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicConsultation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'document_path',
        'thumbnail',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }
}
