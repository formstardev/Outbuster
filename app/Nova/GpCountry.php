<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class GpCountry extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\GpCountry::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'country_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'country_name',
        'country_flag',
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
        return __('Pays');
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
            new Panel('Identifiant du pays', $this->CountryID()),

            new Panel('Drapeau du pays', $this->CountryFlag()),

            new Panel('Pays', $this->CountryName()),
        ];
    }

    /**
     * Get the country id fields for the resource.
     *
     * @return array
     */
    protected function CountryID()
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
        ];
    }

    /**
     * Get the country flag fields for the resource.
     *
     * @return array
     */
    protected function CountryFlag()
    {
        return [
            Image::make('Drapeau', 'country_flag')

                ->store(function (Request $request, $model) {

                    $filename = $request->country_flag->getClientOriginalName();
                    $request->country_flag->storeAs('media/parameters/country/flags', $filename, 'public');

                    return [
                        'country_flag' => 'media/parameters/country/flags/' . $filename,
                    ];

                })

                ->maxWidth(300)
                ->nullable()
                ->prunable()
                ->sortable(),
        ];
    }

    /**
     * Get the country name fields for the resource.
     *
     * @return array
     */
    protected function CountryName()
    {
        return [
            Text::make('Pays','country_name')
                ->rules('required')
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
