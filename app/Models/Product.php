<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'saleprice',
        'discount',
        'is_top',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(
            AttributeValue::class,  // Переконайтеся, що ця модель існує!
            'product_attribute_values',  // таблиця зв'язку
            'product_id',
            'value_id'
        )->withPivot('attribute_id')->withTimestamps();
    }

    // Додайте також зв'язок для отримання атрибутів через значення
    public function attributeValues()
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

    public function addGalleryImages(array $files): void
    {
        foreach ($files as $file) {
            $this->addMedia($file)->toMediaCollection('gallery');
        }
    }

    // Отримати всі зображення галереї
    public function getGalleryImages()
    {
        return $this->getMedia('gallery');
    }

    public static function topProducts()
    {
        return Product::with(['attributes' => function($q) {
                $q->wherePivot('attribute_id', 13);
            }, 'media', 'category'])
            ->where('is_top', true)
            ->latest('id')
            ->get();
    }   

}
