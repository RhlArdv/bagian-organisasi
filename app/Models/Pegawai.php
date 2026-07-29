<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'pangkat_golongan',
        'pendidikan',
        'foto',
        'email',
        'phone',
        'level',
        'parent_id',
        'order_index',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Atasan langsung.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'parent_id');
    }

    /**
     * Bawahan langsung.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'parent_id')->orderBy('order_index');
    }

    /**
     * Bawahan rekursif (untuk tree view).
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Scope: hanya pegawai aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }

    /**
     * Scope: hanya kepala bagian (root node untuk struktur organisasi).
     */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }
}
