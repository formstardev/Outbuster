@extends('layouts.app')


@section('content')
    <!-- outbuster Main -->
    <main class="home">

        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner">
                <div class="img-wrap"><img
                        src="{{ isset($film->film_cover) ? asset('storage/' . $film->film_cover) : asset('assets/images/banner-img.jpg') }}"
                        alt="banner" class="banner-image"></div>
                <div class="banner-text">
                    <div class="small-title"> <img src="{{ asset('assets/images/small-title-logo.png') }}"
                            alt="title-logo">FILM</div>
                    <h1 class="title"> {!! $film->film_original_title !!} </h1>
                    <h2 class="sub-title"> {!! $film->film_tagline !!} </h1>
                        <p> {!! (strlen($film->film_synopsis)<280)?$film->film_synopsis:substr($film->film_synopsis,0,280).'...' !!} </p>
                        <div class="btn-wrap">
                            <a href="#0" class="btn-style2">PLAY <img src="{{ asset('assets/images/play-btn.png') }}"
                                    alt="play">
                            </a>
                            <a href="javascript:;" id="information-btn" class="btn-style2">INFORMATIONS <img
                                    src="{{ asset('assets/images/info-btn.png') }}" alt="info"> </a>
                        </div>
                </div>
            </div>
        </div>

        <!-- popular-videos slider -->
        @include('layouts.popular-video')
        
        {{-- <section class="popular-videos">
            <div class="slider slider1">
                <div class="section-title">
                    <h2>Populaire sur OUT<span>BUSTER</span></h2>
                </div>
                <div class="owl-carousel owl-theme">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="item"><img src="{{ asset('storage/' . $film->film_cover) }}" alt="slider"></div>
                    @endfor
                </div>
                <div class="owl-carousel owl-theme">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="item"><img src="{{ asset('storage/' . $film->film_cover) }}" alt="slider"></div>
                    @endfor
                </div>
            </div>
        </section> --}}
    </main>


    {{-- category-pop category-maximize category-pop film-details-pop popup --}}
    <div class="category-pop category-maximize">
        <a href="javascript:void(0);" class="close-item"><span></span></a>
        <div class="banner-wrap">
            <div class="banner">
                <div class="img-wrap">
                    <img src="{{ asset('storage/' . $film->film_cover) }}" alt="banner" class="banner-image">
                </div>
            </div>
            <div class="details">
                <div class="activities">
                    <div class="activity-buttons">
                        <a href="#0" class="btn">Lecture</a>
                        <a href="#0" class="heart">
                            @if ($film->is_favorited == 1)
                                <img class="heart-img" src="{!! url('assets/images/heart-fill-icon.png') !!}" data-id="{{ $film->id }}"
                                    alt="Heart">
                            @else
                                <img class="heart-img" src="{!! url('assets/images/heart-icon.png') !!}" data-id="{{ $film->id }}"
                                    alt="Heart">
                            @endif
                        </a>
                    </div>
                </div>
                <h2 class="title">{{ $film->film_original_title }}</h2>
                <p>{!! $film->film_synopsis !!}</p>
                <div class="production-text">
                    <ul class="production-details">
                        <li>Pays d'origine :<strong>
                                {{ App\Models\GpCountry::where('id', $film->film_country_id)->first()->country_name ?? '' }}</strong>
                        </li>
                        <li>Classification : <strong>{{ $film->film_certification }}</strong></li>
                        <li>Catégorie :<strong> @php
                            $result = '';
                            $film_category = $film->film_category;
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
                            $film_genre = $film->film_genre;
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
                            $crews = App\Models\FilmCrewMember::where('film_id', $film->id)->get();
                        @endphp
                                @foreach ($crews as $index => $item)
                                    @if ($index == count($crews)-1)
                                        {{ $item->film_crew_name }}
                                    @else
                                        {{ $item->film_crew_name . ',' }}
                                    @endif
                                @endforeach
                            </strong></li>
                        <li>Avec :<strong>
                                @php
                                    $casts = App\Models\FilmCastMember::where('film_id', $film->id)->get();
                                @endphp
                                @foreach ($casts as $index => $item)
                                    @if ($index == count($casts)-1)
                                        {{ $item->film_cast_name }}
                                    @else
                                        {{ $item->film_cast_name . ',' }}
                                    @endif
                                @endforeach
                            </strong></li>
                        <li>Durée :<strong> {{ $film->film_running_time }}</strong></li>
                        <li>Film en :<strong> {{ $film->film_version }}</strong></li>
                    </ul>
                    <div class="tags">
                        <h3>TAGS :</h3>
                        <ul>
                            @php
                                $film_tag = $film->film_tag;
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
                @foreach (App\Models\FilmCritic::where('film_id', $film->id)->get() as $item)
                    <div class="critic-container">
                        <div class="critic-wrapper">
                            <div class="critics-content">
                                <h2 class="critic-title">{{ $item->film_critic_title }}</h2>
                                @php
                                    $critic = App\Models\MpArtworkCritic::where('id', $item->film_critic_name_id)->first();
                                @endphp
                                <a href="{{ $critic->artwork_critic_website }}" class="critic-website">
                                    <img src="{{ asset('storage/' . $critic->artwork_critic_logotype ?? '') }}"
                                        class="critic-logotype">
                                </a>
                            </div>
                        </div>
                        <div class="critic">
                            <p>
                                {{ $item->film_criticism }}
                            </p>
                        </div>
                        <div class="complete-criticism">
                            <a href="{{ $item->film_complete_criticism_link }}" target="_blank"
                                class="complete-criticism-link">
                                {{ $item->film_complete_criticism }}
                            </a>
                            <br>
                            <a href="{{ $item->film_description_link }}" target="_blank" class="complete-criticism-link">
                                {{ $item->film_description }}
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
                            {{ $film->film_pros }}
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
                            {{ $film->film_cons }}
                        </p>
                    </div>
                </div>
                <div class="more-videos">
                    <h4 class="title">Titres similaires</h4>
                    <div class="row">
                        <div class="col-4">
                            <div class="item-box">
                                <img src="{{ asset('assets/images/more-video-image.jpg') }}" alt="more-video">
                                <div class="item-detail">
                                    <h4>The king of pigs - 18+</h4>
                                    <p>A l'école de la violence</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="item-box">
                                <img src="{{ asset('assets/images/more-video-image.jpg') }}" alt="more-video">
                                <div class="item-detail">
                                    <h4>The king of pigs - 18+</h4>
                                    <p>A l'école de la violence</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="item-box">
                                <img src="{{ asset('assets/images/more-video-image.jpg') }}" alt="more-video">
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
@endsection
