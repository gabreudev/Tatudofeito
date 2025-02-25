<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'worker_id', 'description'];

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function worker() {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'service_id');
    }

}
