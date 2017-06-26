@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('rom.create')}}" class="btn btn-primary pull-left">New Rom</a>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <div class="panel panel-default">
                   <table class="table table-hover table-responsive">
                       <thead>
                       <tr>
                           <th>
                               Rom Name
                           </th>
                           <th>
                               Build Name
                           </th>
                           <th>
                               Generated On
                           </th>
                           <th>
                               Action
                           </th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($roms as $key => $rom)
                           <tr>
                               <td>{{ $rom->name }}</td>
                               <td>{{$rom->build['build_version']}}</td>
                               <td>{{$rom->build['updated_at']}}</td>
                               <td>
                                   <a href="{{route('rom.show', ['rom'=>$rom->id])}}" class="btn btn-default btn-info btn-sm">Show Details</a>
                                   @if($rom->build)
                                       <a href="{{ $rom->build->download_path }}" class="btn btn-sm btn-success">Download</a>
                                   @else
                                       <span class="label label-default">No Build Available</span>
                                   @endif
                               </td>
                           </tr>
                        @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
@endsection
