<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'recipient',
    ];

    /**
     * @param bool $debt
     * @param float $amount
     */
    public function setAmount(bool $debt, float $amount)
    {
        $this->amount = $amount;

        if (!$debt) {
            $this->amount *= -1;
        }
    }
}
