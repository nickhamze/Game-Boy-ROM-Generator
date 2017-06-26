<?php

namespace App\Http\Controllers;

use App\Build;
use App\Rom;
use App\RomImage;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class RomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request)
    {

        $rom = Rom::create([
            'name'=> "build".time()
        ]);
        foreach ($request->rom_images as $rom_image) {
            // Store in folder of the format rom_images/<rom.id>
            $original_name = $rom_image->getClientOriginalName();
            $filename = $rom_image->storeAs(
                'public/rom_images/'.$rom->id, $original_name
            );
            RomImage::create([
                'rom_id' => $rom->id,
                'name' => $filename
            ]);
        }
        $rom->refresh();
        return ["status"=>"success", "message" => "Images successfully uploaded",  "data" =>$rom];
    }

    function build(Rom $rom, Request $request){
        $images = [];
        $rom_name = str_slug($rom->name, '_').'.gb';
        foreach ($rom->rom_images as $rom_image){
            $images[$rom_image->id] = $rom_image->local_path;
        }
        $ordered_images = [];
        foreach ($request->img_order as $order_id){
            array_push($ordered_images, $images[$order_id]);
        }

        $rom_images =implode(" ", $ordered_images);
        $result = $this->generate($rom_name, $rom_images);
        if ($result['status'] == 0) {
            $rom->build()->updateOrCreate([
                'rom_id' => $rom->id,
                'build_version' => $rom_name
            ]);
        }else{
            return ["status" => "error", "message"=>"Failed to build ROM.\n".$result['output'], "data"=>$result['output']];
        }
        $rom->refresh();
        return ["status"=>"success","message"=>"Build successful.Click Download Button",  "data" =>["rom" => $rom, "output" =>$result['output']]] ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function show(Rom $rom)
    {
        return view('roms.show')->with ('rom', $rom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function edit(Rom $rom)
    {
        return view('roms.edit')->with ('rom', $rom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rom $rom)
    {
        $rom->update($request->all());
        return redirect()->route('rom.show', ['rom'=> $rom->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rom $rom)
    {
        //
    }

    protected function generate($name, $images)
    {

        $rombuilds_dir = base_path().'/storage/app/public/rom_builds/';
        if (!file_exists($rombuilds_dir)) {
            mkdir($rombuilds_dir, 0755, true);
        }
        $working_dir =  base_path().'/rombuilder/';
        $rom_output = $rombuilds_dir.$name;
        $format = 'cd %s; python pygbconv.py %s %s';
        $cmd = sprintf($format, $working_dir, $rom_output, $images);
        exec($cmd, $output, $return_var);
        $output_message = implode("\n", array_slice($output, 1));
        return ["status"=>$return_var, "output" => $output_message];
    }
}
