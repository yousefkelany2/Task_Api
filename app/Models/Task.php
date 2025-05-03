<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Task extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'user_id', 'title', 'description', 'due_date', 'is_completed',
    ];
    public function user()
   {
    return $this->belongsTo(User::class);
   }
}
