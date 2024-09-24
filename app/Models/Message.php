<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// Models
use App\Models\User;

class Message extends Model {

    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function user() {

        return $this -> belongsTo(User::class, "sender_id", "id");

    }

    public function getCreatedAtAttribute($value) {
        // app()->setLocale('ar');

        return Carbon::parse($value) -> diffForHumans();

    }

}
