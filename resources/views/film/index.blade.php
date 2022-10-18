@extends('layouts.app')

@section('content')
    <style>
        .category-minimize.show {
            position: fixed;
            top: 50%;
            z-index: -1;
            left: 50%;
            max-height: 100%;
            /* overflow-y: scroll; */
            transform: translate3d(-50%, -50%, 0);
            opacity: 1;
            visibility: visible;
            /* transform: scale(1); */
        }
        .close-item span {
            left: 40%;
        }
    </style>
    <!-- Main -->
    <main>
        <br>
        @foreach ($categories as $category)
            @php
                $user_id = 0;
                if (Auth::user()) {
                    $user_id = Auth::user()->id;
                }
                $film_list = App\Models\Film::select('films.*', DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "' . $user_id . '" AND film_id = films.id ),0) as is_favorited'))
                    ->where('film_category', 'like', "%$category->id%")
                    ->get();
                if (count($film_list) == 0) {
                    continue;
                }
            @endphp
            <!-- Popular Videos -->
            <section class="popular-videos all-films">
                <div class="slider slider1">
                    <div class="section-title">
                        <h2>{{ $category->category }}</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($film_list as $item)
                            <div class="item">
                                <div class="image" data-id="{{ $item->id }}"><img
                                        src="{{ asset('storage/' . $item->film_cover) }}" alt=""></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach

        <div class="category-list">
            @foreach ($films as $item)
                <div class="category-pop category-minimize film-{{ $item->id }}">
                    <a href="javascript:void(0);" class="close-item"><span>&nbsp;</span></a>
                    <div class="banner-wrap">
                        <div class="banner">
                            <div class="img-wrap">
                                <img src="{{ asset('storage/' . $item->film_cover) }}" alt="banner" class="banner-image">
                            </div>
                        </div>
                        <div class="details">
                            <div class="activities">
                                <div class="activity-buttons">
                                    <a href="#0" class="add"><img src="{!! url('assets/images/play-btn.png') !!}" alt="Play"></a>
                                    <a href="#0" class="heart">
                                        @if ($item->is_favorited == 1)
                                            <img class="heart-img" src="{!! url('assets/images/heart-fill-icon.png') !!}"
                                                data-id="{{ $item->id }}" alt="Heart">
                                        @else
                                            <img class="heart-img" src="{!! url('assets/images/heart-icon.png') !!}"
                                                data-id="{{ $item->id }}" alt="Heart">
                                        @endif
                                    </a>
                                </div>
                                <a href="#0" class="extract" data-id="{{ $item->id }}"><img
                                        src="{!! url('assets/images/extract-icon.png') !!}" alt="Extract"></a>
                            </div>
                            <h2 class="title">{{ $item->film_original_title }}</h2>
                            <div class="production-text">
                                <ul class="production-details">
                                    <li>Pays d'origine :<strong>
                                            {{ App\Models\GpCountry::where('id', $item->film_country_id)->first()->country_name ?? '' }}</strong>
                                        &nbsp;
                                        Classification :<strong>{{ $item->film_certification }}</strong></li>
                                    <li>Genre :<strong> @php
                                        $result = '';
                                        $film_genre = $item->film_genre;
                                        if (!is_null($film_genre)) {
                                            $film_genre_array = explode(',', $film_genre);
                                            foreach ($genres as $key => $genre) {
                                                if (in_array($genre->id, $film_genre_array)) {
                                                    if ($result != '') {
                                                        $result .= ', ';
                                                    }
                                                    $result .= $genre->genre;
                                                }
                                            }
                                        }
                                        echo $result;
                                        
                                    @endphp</strong></li>
                                    <li>Catégorie :<strong> @php
                                        $result = '';
                                        $film_category = $item->film_category;
                                        if (!is_null($film_category)) {
                                            $film_category_array = explode(',', $film_category);
                                            foreach ($categories as $key => $category) {
                                                if (in_array($category->id, $film_category_array)) {
                                                    if ($result != '') {
                                                        $result .= ', ';
                                                    }
                                                    $result .= $category->category;
                                                }
                                            }
                                        }
                                        echo $result;
                                        
                                    @endphp</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="category-pop category-maximize film-{{ $item->id }}">
                    <a href="javascript:void(0);" class="close-item"><span></span></a>
                    <div class="banner-wrap">
                        <div class="banner">
                            <div class="img-wrap">
                                <img src="{{ asset('storage/' . $item->film_cover) }}" alt="banner" class="banner-image">
                            </div>
                        </div>
                        <div class="details">
                            <div class="activities">
                                <div class="activity-buttons">
                                    <a href="#0" class="btn"
                                        style="text-align: center;justify-content: center;display: flex;">Lecture</a>
                                    <a href="#0" class="heart">
                                        @if ($item->is_favorited == 1)
                                            <img class="heart-img" src="{!! url('assets/images/heart-fill-icon.png') !!}"
                                                data-id="{{ $item->id }}" alt="Heart">
                                        @else
                                            <img class="heart-img" src="{!! url('assets/images/heart-icon.png') !!}"
                                                data-id="{{ $item->id }}" alt="Heart">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <h2 class="title">{{ $item->film_original_title }}</h2>
                            <p>{!! $item->film_synopsis !!}</p>
                            <div class="production-text">
                                <ul class="production-details">
                                    <li>Pays d'origine :<strong>
                                            {{ App\Models\GpCountry::where('id', $item->film_country_id)->first()->country_name ?? '' }}</strong>
                                    </li>
                                    <li>Classification :<strong>{{ $item->film_certification }}</strong>
                                    </li>
                                    <li>Catégorie :<strong> @php
                                        $result = '';
                                        $film_category = $item->film_category;
                                        if (!is_null($film_category)) {
                                            $film_category_array = explode(',', $film_category);
                                            foreach ($categories as $key => $category) {
                                                if (in_array($category->id, $film_category_array)) {
                                                    if ($result != '') {
                                                        $result .= ', ';
                                                    }
                                                    $result .= $category->category;
                                                }
                                            }
                                        }
                                        echo $result;
                                        
                                    @endphp</strong></li>
                                    <li>Genre :<strong> @php
                                        $result = '';
                                        $film_genre = $item->film_genre;
                                        if (!is_null($film_genre)) {
                                            $film_genre_array = explode(',', $film_genre);
                                            foreach ($genres as $key => $genre) {
                                                if (in_array($genre->id, $film_genre_array)) {
                                                    if ($result != '') {
                                                        $result .= ', ';
                                                    }
                                                    $result .= $genre->genre;
                                                }
                                            }
                                        }
                                        echo $result;
                                        
                                    @endphp</strong></li>
                                    <li>Réalisé par :<strong> @php
                                        $crews = App\Models\FilmCrewMember::where('film_id', $item->id)->get();
                                    @endphp
                                            @foreach ($crews as $index => $one)
                                                @if ($index != 0)
                                                    ,
                                                @endif
                                                {{ $one->film_crew_name }}
                                            @endforeach
                                        </strong></li>
                                    <li>Avec :<strong>
                                            @php
                                                $casts = App\Models\FilmCastMember::where('film_id', $item->id)->get();
                                            @endphp
                                            @foreach ($casts as $index => $one)
                                                @if ($index != 0)
                                                    ,
                                                @endif
                                                {{ $one->film_cast_name }}
                                            @endforeach
                                        </strong></li>
                                    <li>Durée :<strong> {{ $item->film_running_time }}</strong></li>
                                    <li>Film en :<strong> {{ $item->film_version }}</strong></li>
                                </ul>
                                <div class="tags">
                                    <h3>TAGS :</h3>
                                    <ul>
                                        @php
                                            $film_tag = $item->film_tag;
                                            if (!is_null($film_tag)) {
                                                $film_tag_array = explode(',', $film_tag);
                                                foreach ($tags as $key => $tag) {
                                                    if (in_array($tag->id, $film_tag_array)) {
                                                        echo '<li>' . $tag->tag . '</li>';
                                                    }
                                                }
                                            }
                                            
                                        @endphp
                                    </ul>
                                </div>
                            </div>
                            @foreach (App\Models\FilmCritic::where('film_id', $item->id)->get() as $one)
                                <div class="critic-container">
                                    <div class="critic-wrapper">
                                        <div class="critics-content">
                                            <h2 class="critic-title">{{ $one->film_critic_title }}</h2>
                                            @php
                                                $critic = App\Models\MpArtworkCritic::where('id', $one->film_critic_name_id)->first();
                                            @endphp
                                            <a href="{{ $critic->artwork_critic_website }}" class="critic-website">
                                                <img src="{{ asset('storage/' . $critic->artwork_critic_logotype ?? '') }}"
                                                    class="critic-logotype">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="critic">
                                        <p>
                                            {{ $one->film_criticism }}
                                        </p>
                                    </div>
                                    <div class="complete-criticism">
                                        <a href="{{ $one->film_complete_criticism_link }}" target="_blank"
                                            class="complete-criticism-link">
                                            {{ $one->film_complete_criticism }}
                                        </a>
                                        <br>
                                        <a href="{{ $one->film_description_link }}" target="_blank"
                                            class="complete-criticism-link">
                                            {{ $one->film_description }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pros-container">
                                <div class="pros-wrapper">
                                    <div class="pros-content">
                                        <h2 class="pros-title">Pourquoi ?</h2>
                                    </div>
                                </div>
                                <div class="pros">
                                    <p>
                                        {{ $item->film_pros }}
                                    </p>
                                </div>
                            </div>
                            <div class="cons-container">
                                <div class="cons-wrapper">
                                    <div class="cons-content">
                                        <h2 class="cons-title">Pourquoi pas ?</h2>
                                    </div>
                                </div>
                                <div class="cons">
                                    <p>
                                        {{ $item->film_cons }}
                                    </p>
                                </div>
                            </div>
                            <div class="more-videos">
                                <h4 class="title">Titres similaires</h4>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="item-box">
                                            <img src="{{ asset('assets/images/more-video-image.jpg') }}"
                                                alt="more-video">
                                            <div class="item-detail">
                                                <h4>The king of pigs - 18+</h4>
                                                <p>A l'école de la violence</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="item-box">
                                            <img src="{{ asset('assets/images/more-video-image.jpg') }}"
                                                alt="more-video">
                                            <div class="item-detail">
                                                <h4>The king of pigs - 18+</h4>
                                                <p>A l'école de la violence</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="item-box">
                                            <img src="{{ asset('assets/images/more-video-image.jpg') }}"
                                                alt="more-video">
                                            <div class="item-detail">
                                                <h4>The king of pigs - 18+</h4>
                                                <p>A l'école de la violence</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
    <script type="text/javascript">
        $(document).ready(function(e) {

            $('.image').click(function() {
                let film_id = $(this).data('id');
                $(".category-list").siblings().find('.category-minimize, .category-maximize').removeClass(
                    'show');
                $('.category-minimize').removeClass('show');
                $('.category-maximize').removeClass('show');
                $('.category-minimize.film-' + film_id).addClass('show');
                $('.category-minimize.film-' + film_id).css("z-index", "1111111");
                $('.category-maximize.film-' + film_id).css("z-index", "-1");
            });
            $('.extract').click(function() {
                let film_id = $(this).data('id');
                $('.category-minimize').removeClass('show');
                $('.category-maximize').removeClass('show');
                $('.category-minimize.film-' + film_id).removeClass('show');
                $('.category-minimize.film-' + film_id).css("z-index", "-1");
                $('.category-maximize.film-' + film_id).css("z-index", "1111111");
                $('.category-maximize.film-' + film_id).addClass('show');
                $('html').addClass('overflow');
            });
        });
    </script>
@endsection
