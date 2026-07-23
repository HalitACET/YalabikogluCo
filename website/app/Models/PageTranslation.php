<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['locale', 'meta_title', 'meta_description'])]
class PageTranslation extends Model
{
}
