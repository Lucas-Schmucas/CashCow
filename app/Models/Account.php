<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    use HasFactory;
    
    
    protected $fillable = ['iban', 'name', 'bic'];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
