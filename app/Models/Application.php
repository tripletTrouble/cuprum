<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Passport\Client;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * App has many roles
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    /**
     * App has one OAuth Client
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }
}
