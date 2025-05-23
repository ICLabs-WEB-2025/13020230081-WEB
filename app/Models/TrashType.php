<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrashType extends Model
{
    protected $fillable = ['jenis'];

    // Relasi ke jadwal pengangkutan
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'id');
    }

    // Relasi ke laporan
    public function reports()
    {
        return $this->hasMany(\App\Models\Report::class, 'id');
    }
}
