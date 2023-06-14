<?php

namespace App\Orchid\Screens\FindPair;

use App\Models\Crossword;
use App\Models\Find_a_Pair;
use App\Models\Find_a_Pair_Data;
use App\Models\Word;
use App\Orchid\Layouts\Crossword\WordEditLayout;
use App\Orchid\Layouts\FindPair\CreatePairData;
use App\Orchid\Layouts\FindPair\FindPairDataTable;
use App\Orchid\Layouts\FindPair\FindPairEditLayouts;
use App\Orchid\Layouts\Topic\TopicEditLayout;
use Illuminate\Http\Request;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FindPairEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Find_a_Pair $find_a_Pair): iterable
    {
        return [
            'find_a_pair'=>$find_a_Pair,
            'data'=>$find_a_Pair->data
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редагування/створення нового завдання знайди пару';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати пару')
                ->modal('createPair')
                ->modalTitle('Додати пару')
                ->method('createPair')
                ->parameters(['findPair_id'=>'find_a_pair'])
                ->icon('plus'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            \Orchid\Support\Facades\Layout::modal('createPair',CreatePairData::class),
            Layout::block(FindPairEditLayouts::class)
                ->title(__('Інформація про завдання знайди пару'))
                ->description(__('Тут можна редагувати завдання'))
                ->commands(
                    Button::make(__('Зберегти'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        //->canSee($this->user->exists)
                        ->method('save')
                ),
            Layout::table('data',[
                TD::make('title', __('Назва'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (Find_a_Pair_Data $data) {
                        return $data->title;
                    }),
                TD::make('description', __('Опис'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (Find_a_Pair_Data $data) {
                        return $data->description;
                    }),
                TD::make('text', __('Текст'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (Find_a_Pair_Data $data) {
                        return $data->text;
                    }),
                TD::make('image', __('Фото'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (Find_a_Pair_Data $data) {
                        return $data->image;
                    }),
            ])

        ];
    }

    public function createPair(Find_a_Pair $find_a_Pair, Request $request){
        //$data = new Find_a_Pair_Data($request->get('dataPair'));
        $first_request = $request->get('data_first');
        $file1 = Attachment::find($first_request['file'][0]);
        $second_request = $request->get('data_second');
        $file2 = Attachment::find($second_request['file'][0]);
        $dd1 = 'https://walkingwithgod.ugcc.ua/storage/'.$file1->path.$file1->name.'.'.$file1->extension;
        $dd2 = 'https://walkingwithgod.ugcc.ua/storage/'.$file2->path.$file2->name.'.'.$file2->extension;

        $data = Find_a_Pair_Data::all()->last();

        //dd($dd);
        $first = new Find_a_Pair_Data([
            'title'=>$first_request['title'],
            'description'=>$first_request['description'],
            'text'=>$first_request['text'],
            'image'=>$dd1,
            //'pair_id'=>$data->id+1,
            'find_a_pair'=>$find_a_Pair->id,
        ]);
        $first->save();

        $second = new Find_a_Pair_Data([
            'title'=>$first_request['title'],
            'description'=>$first_request['description'],
            'text'=>$first_request['text'],
            'image'=>$dd2,
            //'pair_id'=>$data->id+2,
            'find_a_pair'=>$find_a_Pair->id,
        ]);
        $second->save();

        $first->pair_id = $second->id;
        $first->save();

        $second->pair_id = $first->id;
        $second->save();
        //$p = Attachment::find($ddd[0]);

        //exit();

        //dd($find_a_Pair,$request,$ddd,$p,$dd);
        //$find_a_Pair->data()->save($data);
        //$data = Word::created(['crossword_id'=>$crossword->id],$request->get('words'));
        Toast::info('Оновлено пару');
        return redirect(route('find-pair.show',$find_a_Pair->id));
    }

    public function save(Find_a_Pair $find_a_Pair, Request $request){
        $request->validate([
            'find_a_pair.title' => [
                'required'
            ],
            'find_a_pair.description'=>[
                'required'
            ]
        ]);

        $find_a_Pair->fill($request->get('find_a_pair'))->save();
        //dd($request);
        //exit();
        return redirect()->route('find-pair.show',$find_a_Pair->id);
    }
}
