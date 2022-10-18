<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class Subscription extends Resource
{

    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Subscription::class;

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
        return $this->SubscriptionUser->username;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'subscription_date',
        'subscription_expiration_date',
        'subscription_status',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'SubscriptionUser' => [
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

        'SubscriptionUser.UserCountry' => [
            'country_name',
        ],

        'SubscriptionPlan' => [
            'plan_type',
            'plan_amount',
            'plan_free_period',
            'plan_payment_period',
            'plan_payment_recurring',
            'plan_status',
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
        return __('Abonnements');
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
            new Panel('Identifiant de l\'abonnement', $this->SubscriptionID()),

            new Panel('Abonnement', $this->Subscription()),
        ];
    }

    /**
     * Get the subscription id fields for the resource.
     *
     * @return array
     */
    protected function SubscriptionID()
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
        ];
    }

    /**
     * Get the subscription fields for the resource.
     *
     * @return array
     */
    protected function Subscription()
    {
        return [
            BelongsTo::make('Utilisateur', 'SubscriptionUser', 'App\Nova\User')
                ->rules('required')
                ->sortable(),

            BelongsTo::make('Plan', 'SubscriptionPlan', 'App\Nova\Plan')
                ->rules('required')
                ->sortable(),

            Date::make('Date d\'abonnement','subscription_date')
                ->pickerDisplayFormat('d.m.Y')
                ->rules('required')
                ->sortable(),

            Date::make('Date d\'expiration de l\'abonnement','subscription_expiration_date')
                ->pickerDisplayFormat('d.m.Y')
                ->rules('required')
                ->sortable(),

            Toggle::make('Status','subscription_status')
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
