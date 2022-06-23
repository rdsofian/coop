<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['identity_number', 'name', 'address', 'phone', 'birth_date', 'birth_place'];
}
