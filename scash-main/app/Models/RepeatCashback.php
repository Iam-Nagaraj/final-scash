<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepeatCashback extends Model
{
	use HasFactory;

	protected $fillable = ['user_id', 'merchant_id', 'rp_cashback_balance'];

}
