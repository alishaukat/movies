@extends('layouts.master')

@section('title')
    Movies | {{ $episode->title }}
@stop

@section('content')
@include('layouts.includes.header', array('heading'=>"Episode ".$episode->number, 'subHeading'=>$episode->title, 'back'=>true))
<div class="row vid">
    <iframe width="640" height="360"
        src="{{ $episode->video_url }}">
    </iframe>
</div>
@if(!empty($previous))
<a href='{{ $previous->url }}'><button type="button" class="btn btn-primary">Previous</button></a>
@endif
@if(!empty($next))
<a href='{{ $next->url }}'><button type="button" class="btn btn-primary pull-right">Next</button></a>
@endif
<div class="clearfix"></div>
<hr>
@endsection

@section('foot_asset')
@parent
@stop