<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class FilmCritic extends Resource
{

    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\FilmCritic::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'film_critic_title',
        'film_criticism',
        'film_complete_criticism',
        'film_description',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'FilmCriticName' => [
            'artwork_critic_name',
        ],

    ];

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $sort = [
        'id' => 'asc'
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {

            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$sort), reset(static::$sort));
        }

        return $query;
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Critiques');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),

            BelongsTo::make('Film', 'Film', 'App\Nova\Film')
                ->nullable()
                ->sortable(),

            Text::make('Titre de la critique', 'film_critic_title')
                ->nullable()
                ->sortable(),

            BelongsTo::make('Nom du critique', 'FilmCriticName', 'App\Nova\MpArtworkCritic')
                ->nullable()
                ->sortable(),

            Markdown::make('La critique', 'film_criticism')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),

            Text::make('Lire la critique complète', 'film_complete_criticism')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),

            Text::make('Lire la critique complète link', 'film_complete_criticism_link')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),

            Text::make('Voir la fiche du film', 'film_description')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),
            Text::make('Voir la fiche du film link', 'film_description_link')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),
        ];
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function authorizedToView(Request $request)
    {
        return true;
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param Request $request
     *
     * @return bool
     */
    public static function authorizedToCreate(Request $request)
    {
        return true;
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function authorizedToUpdate(Request $request)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function authorizedToDelete(Request $request)
    {
        return true;
    }

    /**
     * Determine whether the user can search
     *
     * @param Request $request
     *
     * @return bool
     */
    public static function searchable()
    {
        return true;
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
