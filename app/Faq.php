<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $fillable = ['questioner_name', 'questioner_email', 'question', 'category_id', 'answer', 'status_id'];

    public function status()
    {

        return $this->belongsTo('App\Status');
    }

    public function category()
    {

        return $this->belongsTo('App\Category');
    }

    public static function destroy($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                Log::write('Удалил вопрос номер ' . $id);
            }
        } else {
            Log::write('Удалил вопрос номер ' . $ids);
        }
        parent::destroy($ids);
    }

    public function save(array $options = array())
    {
        if (isset($this->id)) {
            Log::write('Обновил вопрос номер ' . $this->id);
        }
        parent::save($options);
    }
}
