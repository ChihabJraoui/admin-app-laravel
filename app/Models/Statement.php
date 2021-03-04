<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'date'];

    protected $appends = ['formatted_amount'];


    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->attributes['amount'], 2);
    }
}
