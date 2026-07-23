<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['sort_order'])]
class VisionValue extends Model
{
    use HasTranslations;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
