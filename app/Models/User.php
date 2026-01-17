<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function installmentContracts()
    {
        return $this->hasMany(InstallmentContract::class, 'created_by');
    }
    public function installmentPayments()
    {
        return $this->hasMany(InstallmentPayment::class, 'paid_by');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'created_by');
    }
    public function paymentWays()
    {
        return $this->hasMany(PaymentWay::class, 'created_by');
    }
    public function paymentWayLogs()
    {
        return $this->hasMany(PaymentWayLog::class, 'created_by');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'created_by');
    }
    public function transactionLogs()
    {
        return $this->hasMany(TransactionLog::class, 'created_by');
    }

      public function associations()
    {
        return $this->hasMany(AssociationMember::class, 'client_id');
    }
      public function associationPayments()
    {
        return $this->hasMany(AssociationPayment::class, 'client_id');
    }

}
