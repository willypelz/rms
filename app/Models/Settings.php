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

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value'];

    public function get($key)
    {
        $setting = $this->where('key', $key)->first();
        if( $setting )
        {
            return $this->where('key', $key)->first()->pluck('value')[0];    
        }
        else
        {
            return null;
        }
        
    }

    public function set($key,$value)
    {
        return $this->where('key', $key)->update([ 'value' => $value ]);
    }


}