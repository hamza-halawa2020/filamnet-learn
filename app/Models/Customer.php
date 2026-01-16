<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'created_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}


