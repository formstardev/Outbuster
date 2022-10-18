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

class Film extends Resource
{

    use SearchesRelations;
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Film::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'film_original_title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'film_original_title',
        'film_country_of_origin',
        'film_version',
        'film_running_time',
        'film_tagline',
        'film_synopsis',
        'film_pros',
        'film_cons',
        'film_cover',
        'film_trailer',
        'film_master_file',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'FilmCastMember' => [
            'film_cast_name',
            'film_cast_character',
        ],

        'FilmCrewMember' => [
            'film_crew_name',
            'film_crew_occupation',
        ],

        'FilmCritic' => [
            'film_critic_title',
            'film_criticism',
            'film_complete_criticism',
            'film_description',
        ],

        'FilmCritic.FilmCriticName' => [
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
        return __('Films');
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

            new Panel('Identifiant du film', $this->FilmID()),

            Tabs::make('Information du film', [

                Tab::make('Titre', [
                    Text::make('Titre original du film', 'film_original_title')
                        ->rules('required')
                        ->sortable(),
                ]),

                Tab::make('Casting', [
                    NestedForm::make('Film Cast Member', 'FilmCastMember', 'App\Nova\FilmCastMember')
                        ->heading(NestedForm::wrapIndex() . '. ' .
                            NestedForm::wrapAttribute('film_cast_name') . ' (' .
                            NestedForm::wrapAttribute('film_cast_character') . ')')
                        ->open(false),

                    HasMany::make('FilmCastMember'),
                ]),

                Tab::make('Équipe de tournage', [
                    NestedForm::make('Film Crew Member', 'FilmCrewMember', 'App\Nova\FilmCrewMember')
                        ->heading(NestedForm::wrapIndex() . '. ' .
                            NestedForm::wrapAttribute('film_crew_name') . ' (' .
                            NestedForm::wrapAttribute('film_crew_occupation') . ')')
                        ->open(false),

                    HasMany::make('FilmCrewMember'),
                ]),

                Tab::make('Information générale', [
                    Text::make('Pays d\'origine', 'film_country_of_origin')
                        ->nullable()
                        ->sortable(),

                    Text::make('Version', 'film_version')
                        ->nullable()
                        ->sortable(),

                    Number::make('Durée (min)', 'film_running_time')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Classification', [
                    BelongsTo::make('Pays', 'film_country', 'App\Nova\GpCountry')
                        ->rules('required')
                        ->sortable(),
                    Text::make('Certification', 'film_certification')
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Description', [
                    Text::make('Slogan', 'film_tagline')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Markdown::make('De quoi ça parle ?', 'film_synopsis')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Thématique', [
                    MultiselectCheckboxes::make('Catégorie', 'film_category')
                        ->options(\App\Models\MpArtworkCategory::all()->pluck('category', 'id'))
                        ->hideFromDetail()
                        ->hideFromIndex()
                        ->nullable()
                        ->placeholder('Veuillez sélectionner le ou les categories de l\'œuvre')
                        ->sortable(),

                    MultiselectCheckboxes::make('Genre', 'film_genre')
                        ->options(\App\Models\MpArtworkGenre::all()->pluck('genre', 'id'))
                        ->hideFromDetail()
                        ->hideFromIndex()
                        ->nullable()
                        ->placeholder('Veuillez sélectionner le ou les genres du film')
                        ->sortable(),

                    MultiselectCheckboxes::make('Tag', 'film_tag')
                        ->options(\App\Models\MpArtworkTag::all()->pluck('tag', 'id'))
                        ->hideFromDetail()
                        ->hideFromIndex()
                        ->nullable()
                        ->placeholder('Veuillez sélectionner le ou les tags du film')
                        ->sortable(),

                    Text::make('Pourquoi ?', 'film_pros')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Text::make('Pourquoi pas ?', 'film_cons')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Critique', [
                    NestedForm::make('Film Critic', 'FilmCritic', 'App\Nova\FilmCritic')
                        ->heading(NestedForm::wrapIndex() . '. ' .
                            NestedForm::wrapAttribute('FilmCriticName'))
                        ->open(false),

                    HasMany::make('FilmCritic'),
                ]),

                Tab::make('Media', [
                    Image::make('Couverture du film', 'film_cover')

                        ->store(function (Request $request, $model) {

                            $filename = $request->film_cover->getClientOriginalName();
                            $request->film_cover->storeAs('media/film/covers', $filename, 'public');

                            return [
                                'film_cover' => 'media/film/covers/' . $filename,
                            ];
                        })

                        ->hideFromIndex()
                        ->maxWidth(300)
                        ->nullable()
                        ->prunable()
                        ->sortable(),

                    File::make('Bande annonce du film', 'film_trailer')

                        ->store(function (Request $request, $model) {

                            $filename = $request->film_trailer->getClientOriginalName();
                            $request->film_trailer->storeAs('media/film/trailers', $filename, 'public');

                            return [
                                'film_trailer' => 'media/film/trailers/' . $filename,
                            ];
                        })

                        ->hideFromIndex()
                        ->nullable()
                        ->prunable()
                        ->sortable(),

                    File::make('Fichier maître du film', 'film_master_file')

                        ->store(function (Request $request, $model) {

                            $filename = $request->film_master_file->getClientOriginalName();
                            $request->film_master_file->storeAs('media/film/master_files', $filename, 'public');

                            return [
                                'film_master_file' => 'media/film/master_files/' . $filename,
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
     * Get the film id fields for the resource.
     *
     * @return array
     */
    protected function FilmID()
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
