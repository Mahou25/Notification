<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    
    use HasFactory;
    protected $fillable=['title','description'];

    public function message(){
        return $this->belongsTo(Message::class);
    }
}
