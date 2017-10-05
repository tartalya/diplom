<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Log;

class Category extends Model
{

    protected $fillable = ['category_name'];

    public static function destroy($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                Log::write('Удалил категорию ' . $id);
            }
        } else {
            Log::write('Удалил категорию ' . $ids);
        }
        parent::destroy($ids);
    }

    public function update(array $attributes = [], array $options = [])
    {
        if (isset($attributes['category_name'])) {
            Log::write('Отредактировал категорию ' . $attributes['category_name']);
        }
        parent::update($attributes, $options);
    }

    public static function create(array $attributes = [])
    {
        
            Log::write('Добавил категорию ' . $attributes['category_name']);
        
        parent::create($attributes);
    }
}
