<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'email', 'organisation_role', 'outcome', 'locale', 'consent_at', 'ip_hash'])]
class ContactSubmission extends Model
{
    protected function casts(): array
    {
        return [
            'consent_at' => 'datetime',
        ];
    }
}
