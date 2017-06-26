<?php

namespace App;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class RomImage extends Model
{
    protected $fillable = ['name', 'rom_id'];
    protected $appends = ['local_path', 'image_path', 'formatted_name'];

    public function rom(){
        return $this->belongsTo('App\Rom');
    }

    public function getImagePathAttribute()
    {
        return secure_asset(Storage::url($this->name));
    }
    public function getLocalPathAttribute()
    {
        return base_path().'/storage/app/'. $this->name;
    }
    public function getFormattedNameAttribute()
    {
        return basename($this->name);
    }
}
