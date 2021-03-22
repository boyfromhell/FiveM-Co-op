<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Markdown;
// use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Mission extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Mission::class;

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
        'id', 'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Boolean::make('Active'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:50'),

            Text::make('Creator')
                ->sortable()
                ->rules('required', 'max:50')
                ->default($request->user()->name),

            Markdown::make('Description')
                ->rules('required', 'max:255'),

            Select::make('Difficulty')
                ->rules('required')
                ->options([
                    'easy' => 'Easy',
                    'medium' => 'Medium',
                    'hard' => 'Hard',
                ])
                ->displayUsingLabels()
                ->sortable(),

            Select::make('Duration')
                ->rules('required')
                ->options([
                    'S' => 'Less than 1 hour',
                    'M' => 'Less than 2 hours',
                    'L' => 'More than 2 hours',
                ])
                ->displayUsingLabels()
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
