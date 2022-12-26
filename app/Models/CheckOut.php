<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;
    protected $table = 'check_out';
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'user_id',
        'product_id'
    ];
}
