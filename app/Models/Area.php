<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Area extends Model
{
    protected $fillable = ['nama_wilayah'];

    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'area_id');
    }

}

