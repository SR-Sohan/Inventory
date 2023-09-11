<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "total",
        "discount",
        "vat",
        "payable",
        "user_id",
        "customer_id"
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
