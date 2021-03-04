<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $casts = [
        'is_main_account' => 'boolean',
        'approved' => 'boolean',
        'created_at' => 'datetime',
    ];

    protected $appends = ['formatted_principal', 'formatted_interest_rate'];

    /**
     * Account belongs to one User
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function statements()
    {
        return $this->hasMany(Statement::class);
    }

    function getFormattedPrincipalAttribute()
    {
        return '$' . number_format($this->attributes['principal'], 2);
    }

    function getFormattedInterestRateAttribute()
    {
        return number_format($this->attributes['interest_rate'], 1) . '%';
    }
}
