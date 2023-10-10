<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['folder_id','path', 'original_name'];


    public function Folder(){
        return $this->belongsTo(Folder::class);
    }
}
