<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\MpArtworkCategory;
use App\Models\MpArtworkGenre;
use App\Models\MpArtworkTag;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }
        $films = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "' . $user_id . '" AND film_id = films.id ),0) as is_favorited')
        )->get();
        $category_id = 0;
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $tags = MpArtworkTag::all();
        return view('category.index', compact('categories', 'genres', 'films', 'category_id', 'tags'));
    }

    public function showFilm($category_id)
    {
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $tags = MpArtworkTag::all();
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }
        $films = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "' . $user_id . '" AND film_id = films.id ),0) as is_favorited')
        )->where('film_category', 'like', "%$category_id%")->get();
        return view('category.index', compact('categories',  'genres', 'films', 'category_id', 'tags'));
    }
}
