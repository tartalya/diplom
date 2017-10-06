<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Log;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function update(array $attributes = [], array $options = [])
    {
        if (isset($attributes['name'])) {
            Log::write('Изменил данные пользователя ' . $attributes['name']);
        }
        parent::update($attributes, $options);
    }

    public static function destroy($ids)
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                Log::write('Удалил пользователя ' . User::where('id', $id)->first()->name);
            }
        } else {
            Log::write('Удалил пользователя ' . User::where('id', $ids)->first()->name);
        }
        parent::destroy($ids);
    }

    public function create(array $attributes = [])
    {
        if (isset($attributes['name'])) {
            Log::write('Добавил пользователя ' . $attributes['name']);
        }
        parent::create($attributes);
    }
}
