<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'lama_sewa',
        'total_harga',
        'payment_method',
        'payment_proof',
        'payment_status',
        'status_sewa',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel items
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
