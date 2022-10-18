<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Nova\MultiselectCheckboxes\MultiselectCheckboxes;
use Titasgailius\SearchRelations\SearchesRelations;
use Whitecube\NovaFlexibleContent\Flexible;
use Yassi\NestedForm\NestedForm;

class Serie extends Resource
{

    use SearchesRelations;
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Serie::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'serie_original_title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'serie_original_title',
        'serie_tagline',
        'serie_synopsis',
        'serie_country_of_origin',
        'serie_version',
        'serie_pros',
        'serie_cons',
        'serie_cover',
        'serie_trailer',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'SerieCastMember' => [
            'serie_cast_name',
            'serie_cast_character',
        ],

        'SerieCrewMember' => [
            'serie_crew_name',
            'serie_crew_occupation',
        ],

        'SerieCritic' => [
            'serie_critic_title',
            'serie_criticism',
            'serie_complete_criticism',
            'serie_description',
        ],

        'SerieCritic.SerieCriticName' => [
            'artwork_critic_name',
        ],

        'SerieEpisode' => [
            'serie_season_number',
            'serie_episode_number',
            'serie_episode_title',
            'serie_episode_synopsis',
            'serie_episode_running_time',
            'serie_episode_cover',
            'serie_episode_trailer',
            'serie_episode_master_file',
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
        return __('Series');
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

            new Panel('Identifiant de la série', $this->SerieID()),

            Tabs::make('Information de la série', [

                Tab::make('Titre', [
                    Text::make('Titre original de la série','serie_original_title')
                        ->rules('required')
                        ->sortable(),
                ]),

                Tab::make('Casting', [
                    NestedForm::make('Serie Cast Member', 'SerieCastMember', 'App\Nova\SerieCastMember')
                        ->heading(NestedForm::wrapIndex() . '. ' . 
                            NestedForm::wrapAttribute('serie_cast_name') . ' (' .
                            NestedForm::wrapAttribute('serie_cast_character') . ')')
                        ->open(false),

                    HasMany::make('SerieCastMember'),
                ]),

                Tab::make('Équipe de tournage', [
                    NestedForm::make('Série Crew Member', 'SerieCrewMember', 'App\Nova\SerieCrewMember')
                        ->heading(NestedForm::wrapIndex() . '. ' . 
                            NestedForm::wrapAttribute('serie_crew_name') . ' (' .
                            NestedForm::wrapAttribute('serie_crew_occupation') . ')')
                        ->open(false),

                    HasMany::make('SerieCrewMember'),
                ]),

                Tab::make('Information générale', [
                    Text::make('Pays d\'origine','serie_country_of_origin')
                        ->nullable()
                        ->sortable(),

                    Text::make('Version','serie_version')
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Classification', [
                    NestedForm::make('Classification', 'SerieRatingSystem', 'App\Nova\SerieRatingSystem')
                        ->heading(NestedForm::wrapIndex() . '. ' . 
                            NestedForm::wrapAttribute('certification_letter'))
                        ->open(false),

                    HasMany::make('SerieRatingSystem'),
                ]),

                Tab::make('Description', [
                    Text::make('Slogan','serie_tagline')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Markdown::make('De quoi ça parle ?','serie_synopsis')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Thématique', [
                    MultiselectCheckboxes::make('Catégorie', 'serie_category')
                        ->options(\App\Models\MpArtworkCategory::all()->pluck('category', 'id'))
                        ->hideFromDetail()
                        ->hideFromIndex()
                        ->nullable()
                        ->placeholder('Veuillez sélectionner le ou les categories de la série')
                        ->sortable(),

                    MultiselectCheckboxes::make('Genre', 'serie_genre')
                        ->options(\App\Models\MpArtworkGenre::all()->pluck('genre', 'id'))
                        ->hideFromDetail()
                        ->hideFromIndex()
                        ->nullable()
                        ->placeholder('Veuillez sélectionner le ou les genres de la série')
                        ->sortable(),

                    MultiselectCheckboxes::make('Tag', 'serie_tag')
                        ->options(\App\Models\MpArtworkTag::all()->pluck('tag', 'id'))
                        ->hideFromDetail()
                        ->hideFromIndex()
                        ->nullable()
                        ->placeholder('Veuillez sélectionner le ou les tags de la série')
                        ->sortable(),

                    Text::make('Pourquoi ?','serie_pros')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Text::make('Pourquoi pas ?','serie_cons')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Épisode', [
                    NestedForm::make('Serie Episode', 'SerieEpisode', 'App\Nova\SerieEpisode')
                        ->heading(NestedForm::wrapIndex() . '. ' . 
                            NestedForm::wrapAttribute('serie_episode_title'))
                        ->open(false),

                    HasMany::make('SerieEpisode'),
                ]),

                Tab::make('Critique', [
                    NestedForm::make('Serie Critic', 'SerieCritic', 'App\Nova\SerieCritic')
                        ->heading(NestedForm::wrapIndex() . '. ' . 
                            NestedForm::wrapAttribute('SerieCriticName'))
                        ->open(false),

                    HasMany::make('SerieCritic'),
                ]),

                Tab::make('Media', [
                    Image::make('Couverture de la série', 'serie_cover')

                        ->store(function (Request $request, $model) {

                            $filename = $request->serie_cover->getClientOriginalName();
                            $request->serie_cover->storeAs('media/serie/covers', $filename, 'public');

                            return [
                                'serie_cover' => 'media/serie/covers/' . $filename,
                            ];

                        })

                        ->hideFromIndex()
                        ->maxWidth(300)
                        ->nullable()
                        ->prunable()
                        ->sortable(),

                    File::make('Bande annonce de la série', 'serie_trailer')

                        ->store(function (Request $request, $model) {

                            $filename = $request->serie_trailer->getClientOriginalName();
                            $request->serie_trailer->storeAs('media/serie/trailers', $filename, 'public');

                            return [
                                'serie_trailer' => 'media/serie/trailers/' . $filename,
                            ];

                        })

                        ->hideFromIndex()
                        ->nullable()
                        ->prunable()
                        ->sortable(),

                ]),

            ]),

        ];
    }

    /**
     * Get the serie id fields for the resource.
     *
     * @return array
     */
    protected function SerieID()
    {
        return [
            ID::make(__('ID'), 'id')
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
