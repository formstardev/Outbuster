<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SerieEpisode extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SerieEpisode::class;

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
        'serie_season_number',
        'serie_episode_number',
        'serie_episode_title',
        'serie_episode_synopsis',
        'serie_episode_running_time',
        'serie_episode_cover',
        'serie_episode_trailer',
        'serie_episode_master_file',
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
        return __('Épisodes');
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

            Text::make('Numéro de la saison','serie_season_number')
                ->nullable()
                ->sortable(),

            Text::make('Numéro de l\'épisode','serie_episode_number')
                ->nullable()
                ->sortable(),

            Text::make('Titre de l\'épisode','serie_episode_title')
                ->nullable()
                ->sortable(),

            Markdown::make('Synopsis de l\'épisode','serie_episode_synopsis')
                ->hideFromIndex()
                ->nullable()
                ->sortable(),

            Number::make('Durée de l\'épisode (min)','serie_episode_running_time')
                ->nullable()
                ->sortable(),

            Image::make('Couverture de l\'épisode', 'serie_episode_cover')

                ->store(function (Request $request, $model) {

                    $filename = $request->serie_episode_cover->getClientOriginalName();
                    $request->serie_episode_cover->storeAs('media/serie/episode/covers', $filename, 'public');

                    return [
                        'serie_episode_cover' => 'media/serie/episode/covers/' . $filename,
                    ];

                })

                ->hideFromIndex()
                ->maxWidth(300)
                ->nullable()
                ->prunable()
                ->sortable(),

            File::make('Bande annonce de l\'épisode', 'serie_episode_trailer')

                ->store(function (Request $request, $model) {

                    $filename = $request->serie_episode_trailer->getClientOriginalName();
                    $request->serie_episode_trailer->storeAs('media/serie/episode/trailers', $filename, 'public');

                    return [
                        'serie_episode_trailer' => 'media/serie/episode/trailers/' . $filename,
                    ];

                })

                ->hideFromIndex()
                ->nullable()
                ->prunable()
                ->sortable(),

            File::make('Fichier maître de l\'épisode', 'serie_episode_master_file')

                ->store(function (Request $request, $model) {

                    $filename = $request->serie_episode_master_file->getClientOriginalName();
                    $request->serie_episode_master_file->storeAs('media/serie/episode/master_files', $filename, 'public');

                    return [
                        'serie_episode_master_file' => 'media/serie/episode/master_files/' . $filename,
                    ];

                })

                ->hideFromIndex()
                ->nullable()
                ->prunable()
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
