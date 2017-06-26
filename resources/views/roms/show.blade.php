@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="text-capitalize">{{$rom->name}}</span>
                        <span class="pull-right">
                            @if($rom->build)
                                <a href="{{ $rom->build->download_path }}" class="btn btn-sm btn-success">Download</a>
                            @else
                                <a href="{{ route('rom.edit', ['rom'=>$rom->id]) }}" class="btn btn-sm btn-info">Edit</a>
                            @endif
                            <a href="{{ route('rom.build', ['rom'=>$rom->id]) }}" class="btn btn-sm btn-primary">Build</a>
                        </span>
                    </div>

                    <div class="panel-body">
                        @foreach($rom->rom_images as $rom_image)
                            <img src="{{$rom_image->image_path}}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
