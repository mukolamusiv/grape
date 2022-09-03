<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Lessons;
use App\Orchid\Layouts\Lessons\LessonsEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class LessonsEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Lessons $lesson): iterable
    {
        $lesson->load('attachment');
        return [
            'lessons'=> $lesson
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редагування уроку';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(LessonsEditLayout::class)
                ->title(__('Інформація про урок'))
                ->description(__('Тут можна редагувати урок'))
                ->commands(
                    Button::make(__('Зберегти'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        //->canSee($this->user->exists)
                        ->method('save')
                ),
        ];
    }



    public function save(Lessons $lessons, Request $request)
    {
        $request->validate([
            'lessons.title' => [
                'required'
            ],
        ]);

//        dd($request);
//        exit();

        $date = Lessons::updateOrCreate(['id'=>$lessons->id],$request->get('lessons'));
        //$lessons
        //$lessons->fill($request->get('lessons'))->save();
        //$lessons->title = $request->input('lessons.title');
        //$lessons->text = $request->input('lessons.text');
        $date->attachment()->syncWithoutDetaching(
            $request->input('lessons.attachment', [])
        );
        //$lessons->record_audio = $request->get('lessons.record_audio');
//        foreach ($request->input('lessons.record_audio') as $file){
//            $lessons->record_audio = $file;
//        }
        //$lessons->save();
//        $permissions = collect($request->get('permissions'))
//            ->map(function ($value, $key) {
//                return [base64_decode($key) => $value];
//            })
//            ->collapse()
//            ->toArray();

//        $lessons->when($request->filled('user.password'), function (Builder $builder) use ($request) {
//            $builder->getModel()->password = Hash::make($request->input('user.password'));
//        });

//        $lessons
////            ->fill($request->collect('user')->except(['password', 'permissions', 'roles'])->toArray())
////            ->fill(['permissions' => $permissions])
//            ->save();

        //$lessons->replaceRoles($request->input('user.roles'));

        Toast::info(__('Дані оновлено.'));

        return redirect()->route('lessons.list');
    }
}
