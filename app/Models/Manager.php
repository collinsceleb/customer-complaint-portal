<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'branch_id', 'phone', 'email'];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
}
