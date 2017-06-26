@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your ROM</div>

                    <div class="panel-body">
                        <form enctype="multipart/form-data" action="{{route('rom.update', ["rom"=> $rom->id])}}" method="POST">
                            {{csrf_field()}}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="location">ROM Name</label>
                                <input required type="text" value="{{$rom->name}}" class="form-control" id="name" name="name" placeholder="">
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label for="avatar">Upload avatar</label>--}}
                            {{--<input type="file" class="form-control" id="avatar" name="avatar" placeholder="" accept="image/">--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Update ROM
                                    </button>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
