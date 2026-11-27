<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUSES = ['menunggu', 'dicuci', 'dikeringkan', 'disetrika', 'selesai'];

protected $fillable = [
    'invoice_number', 'customer_id', 'package_id', 'created_by', 'quantity',
    'unit_price', 'total_price', 'status', 'payment_status',
    'estimated_done_at', 'notes',
];

protected $casts = ['estimated_done_at' => 'datetime'];

public function customer() { return $this->belongsTo(User::class, 'customer_id'); }
public function creator() { return $this->belongsTo(User::class, 'created_by'); }
public function package() { return $this->belongsTo(Package::class); }
public function payments() { return $this->hasMany(Payment::class); }
public function statusLogs() { return $this->hasMany(OrderStatusLog::class); }

public function nextStatus(): ?string
{
    $i = array_search($this->status, self::STATUSES);

    return self::STATUSES[$i + 1] ?? null;
}
}
