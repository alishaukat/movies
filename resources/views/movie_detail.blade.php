@extends('layouts.master')

@section('title')
    @parent | {{ $movie->title }}
@stop

@section('content')
@include('layouts.includes.header', array('heading'=>$movie->title, 'subHeading'=>$movie->rating))
<!-- Movie Row -->
<div class="row">
    <div class="col-md-4">
        <img class="img-responsive" src="{{ $movie->image_url }}" alt="Movie Image">
    </div>
    <div class="col-md-8">
        <p><strong>Genre:</strong> {{$movie->genre}}</p>
        <p>
            <strong>Summary: </strong>{{ $movie->summary }}
        </p>
    </div>
</div>
<div class="row vid">
    <iframe width="640" height="360"
        src="{{ $movie->video_url }}">
    </iframe>
</div>
<hr>
@endsection

@section('foot_asset')
@parent
@stop