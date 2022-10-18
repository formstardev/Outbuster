@php
    $playhistories = App\Models\PlayHistory::select('films.*', DB::raw('COUNT(play_histories.film_id) AS film_numder'))
        ->join('films', 'films.id', 'play_histories.film_id', 'left')
        ->groupby('play_histories.film_id')
        ->orderby('film_numder', 'DESC')
        ->limit('10')
        ->get();
@endphp

@if (!is_null($playhistories))
    <!-- Popular Videos -->
    <section class="popular-videos">
        <div class="slider slider1">
            <div class="section-title">
                <h2>Populaire sur OUT<span>BUSTER</span></h2>
                </h2>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($playhistories as $item)
                    <div class="item"><img src="{{ asset('storage/' . $item->film_cover) }}" alt="{{$item->film_original_title}}"></div>
                @endforeach
            </div>
        </div>
    </section>
@endif
