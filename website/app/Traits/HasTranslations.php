<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTranslations
{
    /**
     * Get the translations relationship.
     */
    public function translations(): HasMany
    {
        $translationModel = get_class($this) . 'Translation';
        return $this->hasMany($translationModel);
    }

    /**
     * Helper to get a translation with fallback to 'en'.
     */
    public function translate(?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $fallback = config('locales.default', 'en');

        // Try to find translation for the requested locale
        $translation = $this->translations->firstWhere('locale', $locale);

        // If not found and the requested locale is not the fallback, try the fallback
        if (!$translation && $locale !== $fallback) {
            $translation = $this->translations->firstWhere('locale', $fallback);
        }

        return $translation;
    }
}
