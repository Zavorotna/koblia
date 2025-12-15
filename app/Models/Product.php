<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    //
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'saleprice',
        'discount',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(
            AttributeValue::class,
            'product_attribute_values',
            'product_id',
            'value_id'
        )->withPivot('attribute_id')->withTimestamps();
    }

    // Створення продукту з атрибутами
    public static function createProduct(array $data, array $attributes = []): self
    {
        $product = self::create($data);
        if($attributes) {
            $product->syncAttributes($attributes);
        }
        return $product;
    }

    // Оновлення продукту з атрибутами
    public function updateProduct(array $data, array $attributes = []): self
    {
        $this->update($data);
        if($attributes) {
            $this->syncAttributes($attributes);
        }
        return $this;
    }

    // Синхронізація атрибутів
    public function syncAttributes(array $attributes)
    {
        $syncData = [];
        foreach ($attributes as $attributeId => $valueId) {
            if ($valueId) {
                $syncData[$valueId] = ['attribute_id' => $attributeId];
            }
        }
        $this->attributes()->sync($syncData);
    }

    // Додаємо або замінюємо головне зображення
    public function addMainImage($file)
    {
        $this->clearMediaCollection('main');
        $this->addMedia($file)->toMediaCollection('main');
    }

    // Отримати URL головного зображення
    public function getMainImageUrl(): ?string
    {
        return $this->getFirstMediaUrl('main') ?: null;
    }

}
