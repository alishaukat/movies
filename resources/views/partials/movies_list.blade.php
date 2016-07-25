<?php $counter = 1; $totalMovies = count($movies); ?>
@foreach($movies as $movie)

@if( $counter%4 == 0 || $counter == 1)
<!-- Movie Row -->
<div class="row">
@endif
    <div class="col-md-3 portfolio-item">
        <div>
            <h3>
                <a href="{{ route('movie', $movie->url) }}">{{ $movie->title }}</a>
            </h3>
            <strong>Rating: 
                @if(!empty($movie->rating))
                {{ $movie->rating }}
                @else
                Not Rated
                @endif
            </strong>
            <p>{{ str_limit($movie->summary, rand(50, 150)) }}</p>
        </div>
        <a href="{{ route('movie', $movie->url) }}">
            <img class="img-responsive" src="{{ $movie->image_url }}" alt="Movie Image">
        </a>
    </div>
@if( $counter % 4 == 0 || $counter == $totalMovies)
</div>
<!-- /.row -->
@endif
<?php $counter++; ?>
@endforeach