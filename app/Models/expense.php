<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "amount",
        "date",
        "bank_id",
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
