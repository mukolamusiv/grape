<?php

namespace App\Orchid\Screens\Crossword;

use App\Models\Crossword;
use App\Orchid\Layouts\Crossword\CrosswordEditLayout;
use App\Orchid\Layouts\Crossword\CrosswordTableLayout;
use App\Orchid\Layouts\Crossword\WordEditLayout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;

class CrosswordScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'crosswords' => Crossword::all(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Кросворди для уроків';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати кросворд')
                ->modal('createCrossword')
                ->modalTitle('Створення нового кросворду')
                ->method('createCrossword')
                //->parameters(['lesson_id'=>'crossword'])
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
            CrosswordTableLayout::class,
            \Orchid\Support\Facades\Layout::modal('createCrossword',CrosswordEditLayout::class)
        ];
    }

    public function createCrossword(Request $request){
        $data = new Crossword($request->get('crossword'));
        if($data->save()){
            Toast::success('Новий кросворд додано');
        }else{
            Toast::error('Відбулась помилка'); 
        }
    }

    public function removeCrossword(Request $request){
        Crossword::destroy($request->get('id'));
        Toast::success('Видалено кросворд');
        return redirect(route('crossword.list'));
    }
}
