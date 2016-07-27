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
<hr>
@endsection

@section('foot_asset')
@parent
@stop