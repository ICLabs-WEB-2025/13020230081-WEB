<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TrashType;
class Schedule extends Model
{
    protected $fillable = ['area_id', 'trash_type_id', 'tanggal', 'waktu', 'user_id'];


    public function area()
    {
    return $this->belongsTo(Area::class, 'area_id');
    }



    public function trashType()
    {
        return $this->belongsTo(TrashType::class, 'trash_type_id');
    }

}
