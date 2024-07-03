<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'city', 'state', 'phone', 'email'];

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
