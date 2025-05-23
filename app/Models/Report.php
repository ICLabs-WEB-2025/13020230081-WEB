<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['nama_pengirim', 'lokasi', 'trash_type_id','deskripsi', 'foto','status'];
   
    public function trashType()
    {
        return $this->belongsTo(TrashType::class);
    }

}
