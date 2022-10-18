<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class SerieRatingSystem extends Resource
{

    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SerieRatingSystem::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'certification_letter';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'certification_type',
        'certification_letter',
        'certification',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'CertificationCountry' => [
            'country_name',
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
        return __('Systèmes de classification');
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

            BelongsTo::make('Pays', 'CertificationCountry', 'App\Nova\GpCountry')
                ->rules('required')
                ->sortable(),

            Select::make('Type de certification','certification_type')
                ->options([
                    'Cinéma' => 'Cinéma',
                    'Physique' => 'Physique',
                    'Numérique' => 'Numérique',
                    'TV' => 'TV',
                ])
                ->rules('required')
                ->sortable(),

            Text::make('Lettre de certification','certification_letter')
                ->rules('required')
                ->sortable(),

            Image::make('Certification', 'certification')

                ->store(function (Request $request, $model) {

                    $filename = $request->certification->getClientOriginalName();
                    $request->certification->storeAs('media/parameters/artwork/certification', $filename, 'public');

                    return [
                        'certification' => 'media/parameters/artwork/certification/' . $filename,
                    ];

                })

                ->maxWidth(300)
                ->nullable()
                ->prunable()
                ->sortable(),
        ];
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
