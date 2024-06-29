<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantProfile extends Model
{
    protected $fillable = [
        'user_id', 'company_name', 'address', 'contact', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
