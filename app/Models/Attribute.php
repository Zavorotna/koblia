<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';
    protected $primaryKey = 'id';
    public $fillable = [
        'name',
        "slug",
        'type'
    ];
    /**
     * Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany
     * Define a one-to-many relationship.
     * @param string|null $foreignKey
     * @param string|null $localKey
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<TRelatedModel, $this>
     *
     * @template TRelatedModel of \Illuminate\Database\Eloquent\Model
     *
     * @return void
     */
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
        * Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany
        * Define a one-to-many relationship.
        * @param class-string<TRelatedModel> $related
        * @param string|null $foreignKey
        * @param string|null $localKey
        * @return \Illuminate\Database\Eloquent\Relations\HasMany<TRelatedModel, $this>
        * @template TRelatedModel of \Illuminate\Database\Eloquent\Model
        * @return void
    */
    public function productValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * filterable
     *
     * @param [type] $query
     * @return void
     */
    public function scopeFilterable($query)
    {
        return $query->where('is_filterable', true);
    }

    /**
     * add attribute
     *
     * @param array $data
     * @return self
     */
    public static function addAttribute(array $data): self
    {
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = str($data['name'])->slug();
        }
        return Attribute::create($data);
    }

    /**
     * select attribute
     *
     * @param integer $id
     * @return self
     */
    public static function selectAttribute(int $id): self
    {
        return Attribute::with('values')->findOrFail($id);
    }

    /**
     * update
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public static function updateAttribute(array $data, int $id): bool
    {
        return Attribute::where('id', $id)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return boolean
     */
    public static function deleteAttribute(int $id): bool
    {
        return Attribute::where('id', $id)->delete();
    }

}
