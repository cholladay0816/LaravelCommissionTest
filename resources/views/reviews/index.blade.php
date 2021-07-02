<x-agnostic-layout>
    @foreach($reviews as $review)

        Review from {{$review->user->name}} for commission {{$review->commission->displayTitle()}}

    @endforeach

</x-agnostic-layout>
