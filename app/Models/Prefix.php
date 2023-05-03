<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    use HasFactory;
    protected $fillable = ['unit_type','post_status_id'];
    
    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
    }
}
