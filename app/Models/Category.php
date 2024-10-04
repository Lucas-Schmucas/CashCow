<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Category extends Model {

    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function accounts() {
        return $this->hasMany(Account::class);
    }
}
