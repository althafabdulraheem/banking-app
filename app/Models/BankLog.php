<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankLog extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'amount', 'type', 'details','balance', 'created_at', 'updated_at'];
}
