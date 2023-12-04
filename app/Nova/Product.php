<?php

namespace App\Nova;

use App\Nova\Filters\ProductBrand;
use App\Nova\Metrics\AveragePrice;
use App\Nova\Metrics\NewProducts;


use App\Nova\Metrics\ProductsPerDay;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
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
        'id', 'name', 'price', 'description', 'sku', 'quantity', "is_published",
    ];

   public static $tableStyle = 'tight';
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

            Slug::make('Slug','slug')
                ->from('name')
                ->required()
                ->hideFromIndex()
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]]),

            Text::make('Name','name')
                ->required()
                ->showOnPreview()
                ->placeholder('Product name...')
                ->textAlign('left')
                ->sortable(),

            Markdown::make('Description','description')
                ->required()
                ->showOnPreview(),

            Number::make('Price','price')
                ->required()
                ->showOnPreview()
                ->placeholder('"Product price')
                ->textAlign('center')
                ->sortable(),

            Text::make('Sku','sku')
                ->required()
                ->placeholder('Product SKU...')
                ->textAlign('center')
                ->sortable(),

            Number::make('Quantity','quantity')
                ->required()
                ->showOnPreview()
                ->placeholder('Product quantity...')
                ->textAlign('center')
                ->sortable(),

            Boolean::make('Status', 'is_published')
                ->required()
                ->textAlign('center')
                ->sortable(),

            BelongsTo::make('Brand')
                ->sortable()
                ->showOnPreview()
                ->textAlign('center')
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
        return [
            new NewProducts(),
            new AveragePrice(),
            new ProductsPerDay(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [
//            new ProductBrand(),
        ];
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
