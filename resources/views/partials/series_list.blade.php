<?php 
$index = 0; 
$counter = 0;
$total = count($series);
?>
@foreach($series as $s)

@if(++$index == 1)
<!-- Movie Row -->
<div class="row">
@endif
    <div class="col-md-3 portfolio-item">
        <div>
            <h3>
                <a href="{{ route('series.show', $s->url) }}">{{ $s->title }}</a>
            </h3>
            <strong>Rating: 
                @if(!empty($s->rating))
                {{ $s->rating }}
                @else
                Not Rated
                @endif
            </strong>
            <p>{{ str_limit($s->summary, 130) }}</p>
        </div>
        <a href="{{ route('series.show', $s->url) }}">
            <img class="img-responsive" src="{{ $s->image_url }}" alt="Series Image">
        </a>
    </div>
@if($index == 4 && $total != $counter)
<?php $index=0; ?>
</div>
<!-- /.row -->
@endif
<?php $counter++; ?>
@endforeach