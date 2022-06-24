<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['loan_date', 'customer_id', 'amount', 'status', 'finish_date', 'user_id'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
