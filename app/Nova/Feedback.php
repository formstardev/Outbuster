<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class Feedback extends Resource
{

    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Feedback::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->FeedbackUser->username;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'feedback_type',
        'feedback',
        'feedback_resolution_date',
        'feedback_status',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'FeedbackUser' => [
            'username',
            'email',
            'first_name',
            'last_name',
            'date_of_birth',
            'gender',
            'avatar',
            'address',
            'zip_code',
            'city',
            'newsletter_subscription',
        ],

        'FeedbackUser.UserCountry' => [
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
        return __('Commentaires');
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
            new Panel('Identifiant du commentaire', $this->FeedbackID()),

            new Panel('Commentaire', $this->Feedback()),
        ];
    }

    /**
     * Get the feedback id fields for the resource.
     *
     * @return array
     */
    protected function FeedbackID()
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
        ];
    }

    /**
     * Get the feedback fields for the resource.
     *
     * @return array
     */
    protected function Feedback()
    {
        return [
            BelongsTo::make('Utilisateur', 'FeedbackUser', 'App\Nova\User')
                ->rules('required')
                ->sortable(),

            Select::make('Type de commentaire','feedback_type')
                ->options([
                    'Abonnement' => 'Abonnement',
                    'Problème technique' => 'Problème technique',
                    'Proposition' => 'Proposition',
                ])
                ->rules('required')
                ->sortable(),

            Markdown::make('Commentaire','feedback')
                ->hideFromIndex()
                ->nullable()
                ->rules('required')
                ->sortable(),

            Date::make('Date','feedback_resolution_date')
                ->pickerDisplayFormat('d.m.Y')
                ->nullable()
                ->rules('required')
                ->sortable(),

            Toggle::make('Status','feedback_status')
                ->editableIndex()
                ->falseColor('#e74444')
                ->falseValue('0')
                ->rules('required')
                ->sortable()
                ->trueColor('#21b978')
                ->trueValue('1'),
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
