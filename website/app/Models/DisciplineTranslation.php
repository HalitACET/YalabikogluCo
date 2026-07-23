<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['locale', 'title', 'dek', 'pull_quote', 'areas_of_focus'])]
class DisciplineTranslation extends Model
{
    protected function casts(): array
    {
        return [
            'areas_of_focus' => 'array',
        ];
    }
}
