<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class Plan extends Resource
{

    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Plan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'plan_type';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'amount',
        'free_period',
        'payment_period',
        'payment_recurring',
        'status',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [];

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
        return __('Plans');
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
            new Panel('Identifiant du plan', $this->PlanID()),

            new Panel('Plan', $this->Plan()),
        ];
    }

    /**
     * Get the plan id fields for the resource.
     *
     * @return array
     */
    protected function PlanID()
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
        ];
    }

    /**
     * Get the plan fields for the resource.
     *
     * @return array
     */
    protected function Plan()
    {
        return [
            Text::make('Name', 'name')
                ->rules('required')
                ->sortable(),

            Text::make('Description', 'description')
                ->rules('required')
                ->sortable(),

            Text::make('Frequency', 'frequency')
                ->rules('required')
                ->sortable(),

            Number::make('Montant de l\'abonnement', 'amount')
                ->rules('required')
                ->sortable(),

                
            Number::make('Période offerte', 'free_period')
                ->rules('required')
                ->sortable(),

            Number::make('Période de paiement', 'payment_period')
                ->rules('required')
                ->sortable(),

            Toggle::make('Renouvellement automatique', 'payment_recurring')
                ->falseColor('#e74444')
                ->falseValue('0')
                ->rules('required')
                ->sortable()
                ->trueColor('#21b978')
                ->trueValue('1'),
            Text::make('Stripe Prod ID', 'stripe_prod_id')
                ->rules('required')
                ->sortable(),
            Text::make('Stripe Plan Id', 'stripe_plan_id')
                ->rules('required')
                ->sortable(),
            Toggle::make('Status', 'status')
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
