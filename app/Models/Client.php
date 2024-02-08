<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends \Laravel\Passport\Client
{
    /**
     * Client secret belongs to application
     * 
     * @return BelongsTo
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function skipsAuthorization(): bool
    {
        if ($this->application !== null) {
            return true;
        }

        return false;
    }
}
