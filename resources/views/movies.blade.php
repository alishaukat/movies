@extends('layouts.master')

@section('title')
    @parent | All
@stop

@section('content')
<!-- Search filters -->
<div class="container">
    <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#title">Title</a></li>
                      <li><a href="#genre">Genre</a></li>
                      <li><a href="#rating">Rating</a></li>
                      <li class="divider"></li>
                      <li><a href="#all">All</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" id="search_box" class="form-control" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
	</div>
</div>
<div class="movies-container">
    {!! $movies_list !!}
</div>
<div class="loading">&nbsp;</div>
<hr>
@endsection

@section('foot_asset')
@parent
<script>
$(document).ready(function(e){
    window.loadingInProgress    = false;
    window.fetchAgain           = true;
    
    // for listing pagination
    $(window).on('scroll', function() {
        if ($(window).scrollTop() + $(window).height() + 200 >= $(document).height()) {
            loadMovies(false);
        }
    });
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $('.search-panel span#search_concept').text(concept);
            $('.input-group #search_param').val(param);
    });
    
    var delayTimer;
    /* Search Filters */
    $('#search_box').keyup(function(e){
        if ((window.loadingInProgress === true)) {
            return false;
        };
        window.fetchAgain = true;
        clearTimeout(delayTimer);
        delayTimer = setTimeout(function() {
            loadMovies(true);
        }, 500);
            
    });
});
function loadMovies(emptyList){
    if ((window.loadingInProgress === true) || (window.fetchAgain === false)) {
        return false;
    }
    var searchBy    = $('#search_param').val();
    var searchText  = $('#search_box').val();
    var offset      = $('.portfolio-item').length;
    if(emptyList){
        offset = 0;
    }
    var url = '{{ route("listing") }}';
    $.ajax({
        url: url,
        data:{
            type         : searchBy,
            search       : searchText,
            limit        : 8,
            offset       : offset,
            order_by     : 'title',
            order_by_type: 'asc'
        },
        method: 'GET',
        dataType:'html',
        beforeSend: function () {
            window.loadingInProgress = true;
            $('.loading').show();
        },
        success:function(response){
            response = $.parseJSON(response);
            if(response.status === 'success'){
                var data = response.data;
                if ( emptyList === true ) {
                    $('.movies-container').empty();
                }
                if($.trim(data) === ""){
                    if(emptyList){
                        $('.movies-container').append("<div>No Movies Found</div>");
                    }
                    window.fetchAgain = false;
                }else{
                    $('.movies-container').append(data);
                    window.fetchAgain = true;
                }
            }
        },error: function() {
            window.loadingInProgress = false;
            $('.loading').hide();
            
        },complete: function() {
            window.loadingInProgress = false;
            $('.loading').hide();
        }
    });
}
</script>
@stop