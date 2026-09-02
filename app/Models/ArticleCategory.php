<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function localizedName(): string
    {
        $translationKey = match ($this->name) {
            'Организационный дизайн' => 'organizational_design',
            'Корпоративное управление' => 'corporate_governance',
            'Вознаграждение' => 'compensation',
            'Карьера' => 'career',
            'Lifestyle' => 'lifestyle',
            default => null,
        };

        return $translationKey
            ? __("portal.article_categories.{$translationKey}")
            : $this->name;
    }
}
