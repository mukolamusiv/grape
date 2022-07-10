<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
        $permissions = ItemPermission::group('Уроки')
            ->addPermission('add_lessons', 'Додавати уроки')
            ->addPermission('edit_lessons', 'Редагувати уроки');
        $dashboard->registerPermissions($permissions);

        $permissions = ItemPermission::group('Нагороди')
            ->addPermission('add_awards', 'Додавати нагороди')
            ->addPermission('edit_awards', 'Редагувати нагороди')
            ->addPermission('appointed_awards', 'Призначати нагороди');
        $dashboard->registerPermissions($permissions);
        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Монітори')
                ->icon('monitor')
                ->route('platform.example'),

            Menu::make('Теми')
                ->icon('tag')
                ->route('topic.list')
                ->title('Навчання'),

            Menu::make('Уроки')
                ->icon('speech')
                ->route('lessons.list'),

            Menu::make('Тести')
                ->icon('task')
                ->route('question.list'),

            Menu::make('Кросворди')
                ->icon('table')
                ->route('crossword.list'),

//            Menu::make('Dropdown menu')
//                ->icon('code')
//                ->list([
//                    Menu::make('Sub element item 1')->icon('bag'),
//                    Menu::make('Sub element item 2')->icon('heart'),
//                ]),

//            Menu::make('Basic Elements')
//                ->title('Form controls')
//                ->icon('note')
//                ->route('platform.example.fields'),
//
//            Menu::make('Advanced Elements')
//                ->icon('briefcase')
//                ->route('platform.example.advanced'),
//
//            Menu::make('Text Editors')
//                ->icon('list')
//                ->route('platform.example.editors'),
//
//            Menu::make('Overview layouts')
//                ->title('Layouts')
//                ->icon('layers')
//                ->route('platform.example.layouts'),
//
//            Menu::make('Chart tools')
//                ->icon('bar-chart')
//                ->route('platform.example.charts'),
//
//            Menu::make('Cards')
//                ->icon('grid')
//                ->route('platform.example.cards')
//                ->divider(),
//
//            Menu::make('Documentation')
//                ->title('Docs')
//                ->icon('docs')
//                ->url('https://orchid.software/en/docs'),

//            Menu::make('Changelog')
//                ->icon('shuffle')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
//                ->target('_blank')
//                ->badge(function () {
//                    return Dashboard::version();
//                }, Color::DARK()),

            Menu::make(__('Користувачі'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Ролі'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Профіль')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Система'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
