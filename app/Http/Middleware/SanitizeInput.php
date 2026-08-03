<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class SanitizeInput extends TransformsRequest
{
    /**
     * Attributes that should not be sanitized.
     *
     * @var array<int, string>
     */
    protected $except = [
        'password',
        'password_confirmation',
        'current_password',
        'google_maps_embed',
    ];

    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (in_array($key, $this->except, true) || !is_string($value)) {
            return $value;
        }

        // Membersihkan tag HTML dan script berbahaya secara otomatis
        return strip_tags($value);
    }
}
