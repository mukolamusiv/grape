<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Cropper::make('user.photo')
                ->targetRelativeUrl()
                ->title('Звантажте фото профілю')
                ->width(1000)
                ->height(1000),

            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Ім\'я'))
                ->placeholder(__('Name')),

            Input::make('user.surname')
                ->type('text')
                ->max(255)
                ->title(__('Прізвище'))
                ->placeholder(__('Surname')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

        ];
    }
}
