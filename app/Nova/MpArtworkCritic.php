<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MpArtworkCritic extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\MpArtworkCritic::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'artwork_critic_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'artwork_critic_name',
        'artwork_critic_website',
        'artwork_critic_logotype',
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
            new Panel('Identifiant du critique', $this->ArtworkCriticID()),

            new Panel('Critique', $this->ArtworkCritic()),
        ];
    }

    /**
     * Get the artwork critic id fields for the resource.
     *
     * @return array
     */
    protected function ArtworkCriticID()
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
        ];
    }

    /**
     * Get the artwork critic fields for the resource.
     *
     * @return array
     */
    protected function ArtworkCritic()
    {
        return [
            Text::make('Nom du critique','artwork_critic_name')
                ->rules('required')
                ->sortable(),

            Text::make('Website','artwork_critic_website')
                ->nullable()
                ->sortable(),

            Image::make('Logotype', 'artwork_critic_logotype')

                ->store(function (Request $request, $model) {

                    $filename = $request->artwork_critic_logotype->getClientOriginalName();
                    $request->artwork_critic_logotype->storeAs('media/parameters/artwork/critic/logotypes', $filename, 'public');

                    return [
                        'artwork_critic_logotype' => 'media/parameters/artwork/critic/logotypes/' . $filename,
                    ];

                })

                ->hideFromIndex()
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
