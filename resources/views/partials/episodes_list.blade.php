<?php 
$index = 0; 
$counter = 0;
$total = count($episodes);
?>
@foreach($episodes as $s)

@if(++$index == 1)
<!-- Movie Row -->
<div class="row">
@endif
    <div class="col-md-3 portfolio-item">
        <div>
            <h3>
                <a href="{{ route('episodes.show', $s->url) }}">Episode {{ $s->number }}</a>
            </h3>
            <strong>{{$s->title}}</strong>
            <p>{{ str_limit($s->summary, 130) }}</p>
        </div>
        <a href="{{ route('episodes.show', $s->url) }}">
            <img class="img-responsive" src="{{ $s->image_url }}" alt="Movie Image">
        </a>
    </div>
@if($index == 4 && $total != $counter)
<?php $index=0; ?>
</div>
<!-- /.row -->
@endif
<?php $counter++; ?>
@endforeach