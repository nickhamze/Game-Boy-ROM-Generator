<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:rom {rom_name} {images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Gameboy ROM using input images.
    Will output image slideshow ROM to (output.gb), using any number images.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $rombuilds_dir = base_path().'/storage/app/public/rom_builds/';
        if (!file_exists($rombuilds_dir)) {
        mkdir($rombuilds_dir, 0755, true);
        }
        $working_dir =  base_path().'/rombuilder/';
        $name = $this->argument('rom_name');
        $images= $this->argument('images');
        $rom_output = $rombuilds_dir.$name;
        $format = 'cd %s; python pygbconv.py %s %s';
        $cmd = sprintf($format, $working_dir, $rom_output, $images);
        exec($cmd, $output, $return_var);
    }
}
