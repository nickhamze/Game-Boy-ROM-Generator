@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Your ROM</div>

                    <div class="panel-body">
                        <form enctype="multipart/form-data" action="{{route('rom.store')}}" method="post">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="location">ROM Name</label>
                                <input required type="text" value="" class="form-control" id="name" name="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Upload ROM Images</label>
                                <input type="file" class="form-control" id="rom_images" name="rom_images[]" placeholder="" accept="image/" multiple/>
                            </div>
                            <div class="form-group">
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Save ROM
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
