<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $fillable = [
        'text'
    ];

    public function talk()
    {
        return $this->belongsTo(Talk::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
