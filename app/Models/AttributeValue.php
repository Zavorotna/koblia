<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = 'attribute_values';
    protected $primaryKey = 'id';
    public $fillable = [
        'attribute_id',
        'value'
    ];
    
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * create attr value
     *
     * @param array $data
     * @return self
     */

    public static function createValue(array $data): self
    {
        return self::create($data);
    }

    public static function selectAttributeValue(int $id): ?self
    {
        return self::find($id);
    }

    public function updateValue(array $data): self
    {
        $this->update($data);
        return $this;
    }

    public static function deleteValue(int $id): void
    {
        if ($value = self::find($id)) {
            $value->delete();
        }
    }
}
