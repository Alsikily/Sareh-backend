<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

// Models
use App\Models\Message;

class User extends Authenticatable implements JWTSubject {

    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function getPhotoAttribute($value) {

        return $value != null ? asset("storage/files/" . $value): null;

    }

    public function messages() {
        return $this -> hasMany(Message::class, "user_id", 'id');
    }
    
    public function favMessages() {
        return $this -> hasMany(Message::class, "user_id", 'id') -> where('fav', '1');
    }

    public function unReadMessages() {
        return $this -> hasMany(Message::class, "user_id", 'id') -> where('isRead', 0);
    }

}
