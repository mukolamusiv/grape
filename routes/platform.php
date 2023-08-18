<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Example screen');
    });

Route::screen('/lesson', \App\Orchid\Screens\Lessons\LessonsListScreen::class)->name('lessons.list');
Route::screen('/lesson/create', \App\Orchid\Screens\Lessons\LessonsEditScreen::class)->name('lessons.add');
Route::screen('/lesson/{id}/edit', \App\Orchid\Screens\Lessons\LessonsEditScreen::class)->name('lessons.edit');
Route::screen('/lesson/{id}', \App\Orchid\Screens\Lessons\LessonsShowScreen::class)->name('lessons.show');


/*
 * Блок роутів для тестів та кросвордів
 * */

/*Запитання до тестів
 * */
Route::screen('/question', \App\Orchid\Screens\Question\QuestionScreen::class)->name('question.list');
Route::screen('/question/create', \App\Orchid\Screens\Question\QuestionScreen::class)->name('question.create');
Route::screen('/question/{id}/edit', \App\Orchid\Screens\Question\QuestionEditScreen::class)->name('question.edit');
/* варіанти відповідей до тестів */
Route::screen('/answer', \App\Orchid\Screens\Question\AnswerScreen::class)->name('answer.list');
Route::screen('/answer/create', \App\Orchid\Screens\Question\AnswerScreen::class)->name('answer.create');
Route::screen('/answer/{id}/edit', \App\Orchid\Screens\Question\AnswerScreen::class)->name('answer.edit');
/*
 * кінець роутів тестів
 * */


/*
 * Блок кросворду
 * */
Route::screen('/crossword', \App\Orchid\Screens\Crossword\CrosswordScreen::class)->name('crossword.list');
Route::screen('/crossword/create', \App\Orchid\Screens\Crossword\CrosswordScreen::class)->name('crossword.create');
Route::screen('/crossword/{id}/edit', \App\Orchid\Screens\Crossword\WordScreen::class)->name('crossword.edit');


Route::screen('/topic', \App\Orchid\Screens\Topic\TopicScreen::class)->name('topic.list');
Route::screen('/topic/create', \App\Orchid\Screens\Topic\TopicEditScreen::class)->name('topic.create');
Route::screen('/topic/{id}/edit', \App\Orchid\Screens\Topic\TopicEditScreen::class)->name('topic.edit');
Route::screen('/topic/{id}', \App\Orchid\Screens\Topic\TopicShowScreen::class)->name('topic.show');



Route::screen('/fin-pair', \App\Orchid\Screens\FindPair\FindPairList::class)->name('find-pair.list');
Route::screen('/fin-pair/create', \App\Orchid\Screens\FindPair\FindPairEdit::class)->name('find-pair.create');
Route::screen('/fin-pair/{id}', \App\Orchid\Screens\FindPair\FindPairEdit::class)->name('find-pair.edit');
Route::screen('/fin-pair/{id}', \App\Orchid\Screens\FindPair\FindPairEdit::class)->name('find-pair.show');



Route::screen('/one-word', App\Orchid\Screens\OneWord\OneWordList::class)->name('one-word.list');
Route::screen('/one-word/create', App\Orchid\Screens\OneWord\OneWordEdit::class)->name('one-word.create');
Route::screen('/one-word/{id}', App\Orchid\Screens\OneWord\OneWordEdit::class)->name('one-word.edit');



Route::screen('/open-question', App\Orchid\Screens\OpenQuestion\OpenQuestionList::class)->name('open-question.list');
Route::screen('/open-question/create', App\Orchid\Screens\OpenQuestion\OpenQuestionEdit::class)->name('open-question.create');
Route::screen('/open-question/{id}', App\Orchid\Screens\OpenQuestion\OpenQuestionEdit::class)->name('open-question.edit');



Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
