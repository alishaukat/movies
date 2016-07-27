@extends('layouts.master')

@section('title')
    Series | {{ $season->title }}
@stop

@section('content')
@include('layouts.includes.header', array('heading'=>"Season ".$season->number, 'subHeading'=>$season->title, 'back'=>true))
<div class="data-container">
    {!! $episodes_list !!}
</div>
<div class="loading">&nbsp;</div>
<hr>
@endsection

@section('foot_asset')
@parent
@stop