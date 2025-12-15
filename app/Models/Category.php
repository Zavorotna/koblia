<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    //
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $fillable = [
        'title',
        'slug'
    ];

    public static function selectAll()
    {
       return Category::select('id', 'title')->orderBy('id')->get();
    }

    public static function addCategory($title)
    {
        return Category::insert([
            'title' => $title,
            'slug' => str($title)->slug(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public static function selectCategory($id)
    {
        return Category::find($id);
    }

    public static function updateCategory($title, $id)
    {
        return Category::where('id', $id)
            ->update([
                'title' => $title,
                'slug' => str($title)->slug(),
                'updated_at' => now(),
            ]);
    }

    public static function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
    }
}
