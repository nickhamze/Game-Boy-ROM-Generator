<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rom extends Model
{
    protected $fillable = ['name'];
    public $with = ['rom_images', 'build'];

    public function rom_images(){
        return $this->hasMany('App\RomImage');
    }

    public function build(){
        return $this->hasOne('App\Build');
    }

}
