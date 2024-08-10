<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model {

    use HasFactory;

    protected $fillable = ['counterparty_name', 'counterparty_iban', 'counterparty_bic'];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
