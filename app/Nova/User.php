<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Titasgailius\SearchRelations\SearchesRelations;

class User extends Resource
{

    use SearchesRelations;
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'username';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [

        'UserCountry' => [
            'country_name',
        ],

    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Utilisateurs');
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

            new Panel('Identifiant de l\'utilisateur', $this->UserID()),

            Tabs::make('Information de l\'utilisateur', [

                Tab::make('Identification', [ 
                    Text::make('Nom d\'utilisateur','username')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Text::make('Email','email')
                        ->sortable()
                        ->rules('required', 'email', 'max:254')
                        ->creationRules('unique:users,email')
                        ->updateRules('unique:users,email,{{resourceId}}'),

                    Password::make('Mot de passe','password')
                        ->onlyOnForms()
                        ->creationRules('required', 'string', 'min:8')
                        ->updateRules('nullable', 'string', 'min:8'),
                ]),

                Tab::make('Profil', [
                    Text::make('Prénom','first_name')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Text::make('Nom','last_name')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Date::make('Date de naissance','date_of_birth')
                        ->hideFromIndex()
                        ->nullable()
                        ->pickerDisplayFormat('d.m.Y')
                        ->sortable(),

                    Select::make('Sexe','gender')
                        ->options([
                            'Femme' => 'Femme',
                            'Homme' => 'Homme',
                        ])
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Avatar::make('Avatar', 'avatar')

                        ->store(function (Request $request, $model) {

                            $filename = $request->avatar->getClientOriginalName();
                            $request->avatar->storeAs('media/parameters/user/avatars', $filename, 'public');

                            return [
                                'avatar' => 'media/parameters/user/avatars/' . $filename,
                            ];

                        })

                        ->maxWidth(120)
                        ->nullable()
                        ->prunable()
                        ->sortable(),
                ]),

                Tab::make('Adresse', [
                    BelongsTo::make('Pays', 'UserCountry', 'App\Nova\GpCountry')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Text::make('Adresse','address')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Number::make('Code Postal','zip_code')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),

                    Text::make('Ville','city')
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

                Tab::make('Newsletter', [
                    Select::make('Inscription Newsletter','newsletter_subscription')
                        ->options([
                            'Non' => 'Non',
                            'Oui' => 'Oui',
                        ])
                        ->hideFromIndex()
                        ->nullable()
                        ->sortable(),
                ]),

            ]),

        ];
    }

    /**
     * Get the user id fields for the resource.
     *
     * @return array
     */
    protected function UserID()
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
