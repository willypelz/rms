<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value'];

    public function get($key)
    {
        return $this->where('key', $key)->first()->pluck('value')[0];
    }

    public function set($key,$value)
    {
        return $this->where('key', $key)->update([ 'value' => $value ]);
    }


}
