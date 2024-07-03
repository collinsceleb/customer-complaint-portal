<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'branch_id', 'phone', 'email', 'address', 'city', 'state', 'profile_photo'];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function complaints() {
        return $this->hasMany(Complaint::class);
    }
}
