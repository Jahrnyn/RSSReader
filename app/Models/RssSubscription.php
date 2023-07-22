<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RssSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'url'];
    
    // Define the relationship with the User model
    public function user(){
        return $this->belongsTo(User::class);
    }        
}
