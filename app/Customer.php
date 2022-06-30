<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['identity_number', 'name', 'address', 'phone', 'birth_date', 'birth_place'];

    public function loans() {
        return $this->hasMany(Loan::class, 'customer_id');
    }

    public function remainingLoan() {
        $sum = 0;
        foreach($this->loans as $loan) {
            $sum += $loan->remaining;
        }
        return $sum;
    }
}
