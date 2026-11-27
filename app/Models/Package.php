<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description', 'pricing_type', 'price', 'duration_hours', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function orders() { return $this->hasMany(Order::class); }
}
