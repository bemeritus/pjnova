<?php

namespace App\Nova;

use Brick\Money\Currency;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static string $model = \App\Models\Product::class;

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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Slug::make('Slug','slug')
                ->from('name')
                ->required()
                ->hideFromIndex()
                ->withMeta(['extraAttributes' => [
                    'radonly' => true
                ]]),

            Text::make('Name','name')
                ->required()
                ->showOnPreview()
                ->placeholder('Product name...'),

            Markdown::make('Description','description')
                ->required()
                ->showOnPreview(),

            \Laravel\Nova\Fields\Number::make('Price','price')
                ->required()
                ->showOnPreview()
                ->placeholder('"Product price'),

            Text::make('Sku','sku')
                ->required()
                ->placeholder('Product SKU...'),

            \Laravel\Nova\Fields\Number::make('Quantity','quantity')
                ->required()
                ->showOnPreview()
                ->placeholder('Product quantity...'),

            Boolean::make('Status', 'is_published')
                ->required()
                ->showOnPreview(),

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
