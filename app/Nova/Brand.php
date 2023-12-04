<?php

namespace App\Nova;

use Faker\Provider\Text;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;

use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Brand>
     */
    public static string $model = \App\Models\Brand::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    public static $showColumnBorders = true;
    public static $perPageOptions = [50, 100, 150];
    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()
                ->sortable()
                ->textAlign('center'),

            \Laravel\Nova\Fields\Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->updateRules('unique:brands, name, {{resourceId}}')
                ->creationRules('unique:brands, name, {{resourceID}}')
                ->showOnPreview()
                ->textAlign('center'),

            URL::make('Website URL', 'website_url')
                ->showOnPreview()
                ->required()
                ->textAlign('center'),

           \Laravel\Nova\Fields\Text::make('Industry')
                ->sortable()
                ->required()
                ->showOnPreview()
                ->textAlign('center'),

            Boolean::make('Status', 'is_published')
                ->sortable()
                ->showOnPreview()
                ->textAlign('center'),

            HasMany::make('Products')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
