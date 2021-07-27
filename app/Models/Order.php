<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['order_number'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'order_id', 'id');
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', '=', 'success');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', '=', 'failed');
    }

    public function scopePending($query)
    {
        return $query->where('status', '=', 'pending');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', '=', $status);
    }
}
