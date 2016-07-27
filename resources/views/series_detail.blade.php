@extends('layouts.master')

@section('title')
    Series | {{ $series->title }}
@stop

@section('content')
@include('layouts.includes.header', array('heading'=>$series->title, 'subHeading'=>$series->rating, 'back'=>true))
<div class="data-container">
    {!! $seasons_list !!}
</div>
<div class="loading">&nbsp;</div>
<hr>
@endsection

@section('foot_asset')
@parent
@stop