<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Log;
use App\Faq;

class Category extends Model
{

    protected $fillable = ['category_name'];

    public static function destroy($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                Log::write('Удалил категорию ' . $id . ' ' . self::where('id', $id)->first()->category_name);
                Faq::where('category_id', $id)->delete();
            }
        } else {
            Log::write('Удалил категорию ' . $ids . ' ' . self::where('id', $ids)->first()->category_name);
            Faq::where('category_id', $ids)->delete();
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


    public function create(array $attributes = [])
    {
        if (isset($attributes['category_name'])) {
            Log::write('Добавил категорию ' . $attributes['category_name']);
        }
        parent::create($attributes);
    }

    public function faq()
    {
        return $this->hasOne('App\Faq');
    }
}
