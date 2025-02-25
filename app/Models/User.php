<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   use HasFactory;
    protected $fillable = ['name', 'cpf', 'phone', 'email', 'password', 'role', 'specialties', 'average_rating', 'payment_methods', 'daily_value', 'description', 'is_banned', 'email_verified'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function clientServices() {
        return $this->hasMany(Service::class, 'client_id');
    }

    public function workerServices() {
        return $this->hasMany(Service::class, 'worker_id');
    }

    public function clientRequests() {
        return $this->hasMany(Request::class, 'client_id');
    }

    public function workerRequests() {
        return $this->hasMany(Request::class, 'worker_id');
    }
}
