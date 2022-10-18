@extends('layouts.app')

@section('content')
    <main>

        <!-- Categories -->
        <section class="categories">
            <div class="title-wrap">
                <h2>Search Result : {{ $search }}</h2>
            </div>
            <div class="list">
                <div class="row">
                    @foreach ($films as $item)
                        <div class="col">
                            <div class="image"><img src="{{ asset('storage/' . $item->film_cover) }}" alt="">
                            </div>
                            <div class="category-pop category-minimize">
                                <a href="javascript:void(0);" class="close-item"><span>&nbsp;</span></a>
                                <div class="banner-wrap">
                                    <div class="banner">
                                        <div class="img-wrap">
                                            <img src="{{ asset('storage/' . $item->film_cover) }}" alt="banner"
                                                class="banner-image">
                                        </div>
                                    </div>
                                    <div class="details">
                                        <div class="activities">
                                            <div class="activity-buttons">
                                                <a href="#0" class="add"><img src="{!! url('assets/images/play-btn.png') !!}"
                                                        alt="Play"></a>
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
                                            <a href="#0" class="extract"><img src="{!! url('assets/images/extract-icon.png') !!}"
                                                    alt="Extract"></a>
                                        </div>
                                        <h2 class="title">{{ $item->film_original_title }}</h2>
                                        <div class="production-text">
                                            <ul class="production-details">
                                                <li>Pays d'origine :<strong>
                                                        {{ App\Models\GpCountry::where('id', $item->film_country_id)->first()->country_name ?? '' }}</strong>
                                                    &nbsp; Classification:<strong>{{ $item->film_certification }}</strong>
                                                </li>
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
                            <div class="category-pop category-maximize">
                                <a href="javascript:void(0);" class="close-item"><span></span></a>
                                <div class="banner-wrap">
                                    <div class="banner">
                                        <div class="img-wrap">
                                            <img src="{{ asset('storage/' . $item->film_cover) }}" alt="banner"
                                                class="banner-image">
                                        </div>
                                    </div>
                                    <div class="details">
                                        <div class="activities">
                                            <div class="activity-buttons">
                                                <a href="#0" class="btn">Lecture</a>
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
                                                <li>Classification:<strong>{{ $item->film_certification }}</strong></li>
                                                <li>Catégorie:<strong> @php
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
                                                            @if ($index == count($crews))
                                                                {{ $one->film_crew_name }}
                                                            @else
                                                                {{ $one->film_crew_name . ',' }}
                                                            @endif
                                                        @endforeach
                                                    </strong></li>
                                                <li>Avec :<strong>
                                                        @php
                                                            $casts = App\Models\FilmCastMember::where('film_id', $item->id)->get();
                                                        @endphp
                                                        @foreach ($casts as $index => $one)
                                                            @if ($index == count($casts))
                                                                {{ $one->film_cast_name }}
                                                            @else
                                                                {{ $one->film_cast_name . ',' }}
                                                            @endif
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
                                                        <a href="{{ $critic->artwork_critic_website }}"
                                                            class="critic-website">
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
                        </div>
                    @endforeach

                </div>
        </section>

        @include('layouts.popular-video')
    </main>
@endsection
