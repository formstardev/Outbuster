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

class SerieCritic extends Resource
{

    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SerieCritic::class;

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
        'serie_critic_title',
        'serie_criticism',
        'serie_complete_criticism',
        'serie_description',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'SerieCriticName' => [
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

            BelongsTo::make('Serie', 'Serie', 'App\Nova\Serie')
                ->nullable()
                ->sortable(),

            Text::make('Titre de la critique','serie_critic_title')
                ->nullable()
                ->sortable(),

            BelongsTo::make('Nom du critique', 'SerieCriticName', 'App\Nova\MpArtworkCritic')
                ->nullable()
                ->sortable(),

            Markdown::make('La critique','serie_criticism')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),

            Text::make('Lire la critique complète','serie_complete_criticism')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),

            Text::make('Voir la fiche de la série','serie_description')
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
