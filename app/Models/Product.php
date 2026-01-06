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

    public static function createProduct(array $data, array $attributes = []): self
    {
        $product = self::create($data);
        if($attributes) {
            $product->syncAttributes($attributes);
        }
        return $product;
    }

    public function updateProduct(array $data, array $attributes = []): self
    {
        $this->update($data);
        if($attributes) {
            $this->syncAttributes($attributes);
        }
        return $this;
    }

    public function syncAttributes(array $attributes): void
    {
        $syncData = [];

        foreach ($attributes as $attributeId => $value) {
            if (is_array($value)) {
                foreach ($value as $valueId) {
                    $syncData[$valueId] = [
                        'attribute_id' => $attributeId
                    ];
                }
            }
            elseif (!empty($value)) {
                $syncData[$value] = [
                    'attribute_id' => $attributeId
                ];
            }
        }

        $this->attributeValues()->sync($syncData);
    }


    public function addGalleryImages(array $files): void
    {
        foreach ($files as $file) {
            $this->addMedia($file)->toMediaCollection('gallery');
        }
    }

    public function getGalleryImages()
    {
        return $this->getMedia('gallery');
    }

    public static function topProducts()
    {
        $products = Product::with(['media', 'category'])
            ->where('is_top', true)
            ->latest('id')
            ->get();

        foreach ($products as $product) {
            $product->load(['attributeValues' => function($query) {
                $query->wherePivot('attribute_id', 13)
                    ->orWherePivot('attribute_id', 21)
                    ->with('attribute');
            }]);
        }

        return $products;
    } 
    
    public static function getProductWithAttributes($id)
    {
        $product = self::with([
            'media',
            'category',
            'attributeValues.attribute'
        ])->findOrFail($id);
        
        return $product;
    }

}
