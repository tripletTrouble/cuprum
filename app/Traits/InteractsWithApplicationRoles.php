<?php

namespace App\Traits;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait InteractsWithApplicationRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
