<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $fillable = ['build_version', 'rom_id'];
    protected $appends = ['download_path'];

    public function rom(){
        return $this->belongsTo('App\Rom');
    }

    public function getDownloadPathAttribute()
    {
        return asset(Storage::url('public/rom_builds/'.$this->build_version));
    }
}
