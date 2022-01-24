<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    use HasFactory;

    public $fillable = [
        'subject'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
