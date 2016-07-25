@extends('layouts.master')

@section('head_asset')
@parent
@stop

@section('content')
@include('partials.filters')
<div class="movies-container">
@include('partials.movies_list')
@include('partials.movies_list')
@include('partials.movies_list')
@include('partials.movies_list')
    
</div>
<hr>
@endsection

@section('foot_asset')
@parent
@stop