<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    use HasFactory;

    protected $fillable = [
        'account_id', 'counterparty_id', 'booking_date', 'value_date',
        'booking_text', 'purpose', 'amount', 'currency', 'balance_after_booking',
        'remark', 'category', 'tax_relevant', 'creditor_id', 'mandate_reference'
    ];

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function counterparty() {
        return $this->belongsTo(Counterparty::class);
    }
}
