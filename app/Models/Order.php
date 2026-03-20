<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'order_code',
        'amount',
        'status',
        'cart_data',
        'transaction_ref',
        'paid_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
