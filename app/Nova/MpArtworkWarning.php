<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MpArtworkWarning extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\MpArtworkWarning::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'artwork_warning_type';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'artwork_warning_type',
        'artwork_warning_logotype',
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
        return __('Avertissements');
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
            new Panel('Identifiant de l\'avertissement', $this->ArtworkWarningID()),

            new Panel('Avertissement', $this->ArtworkWarning()),
        ];
    }

    /**
     * Get the artwork warning id fields for the resource.
     *
     * @return array
     */
    protected function ArtworkWarningID()
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
        ];
    }

    /**
     * Get the artwork warning fields for the resource.
     *
     * @return array
     */
    protected function ArtworkWarning()
    {
        return [
            Text::make('Type d\'avertissement','artwork_warning_type')
                ->rules('required')
                ->sortable(),

            Image::make('Logotype', 'artwork_warning_logotype')

                ->store(function (Request $request, $model) {

                    $filename = $request->artwork_warning_logotype->getClientOriginalName();
                    $request->artwork_warning_logotype->storeAs('media/parameters/artwork/warning/logotypes', $filename, 'public');

                    return [
                        'artwork_warning_logotype' => 'media/parameters/artwork/warning/logotypes/' . $filename,
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
