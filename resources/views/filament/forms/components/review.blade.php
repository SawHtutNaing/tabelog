@if (is_array($reviews) && count($reviews) > 0)
    @foreach ($reviews as $review)
        {{$review->content}}
    @endforeach
@endif
