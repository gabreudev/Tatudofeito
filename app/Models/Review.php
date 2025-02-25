<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['service_id', 'comment', 'url_image', 'stars'];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
