<?php

namespace App\Orchid\Screens\Crossword;

use App\Models\Crossword;
use App\Models\Lessons;
use App\Models\Word;
use App\Orchid\Layouts\Crossword\CrosswordEditLayout;
use App\Orchid\Layouts\Crossword\WordEditLayout;
use App\Orchid\Layouts\Crossword\WordsTableLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;

class WordScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Crossword $crossword): iterable
    {
        return [
            'crossword'=>$crossword,
            'words'=>$crossword->word,
            //'data' =>$crossword->word,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редагування кросворду';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати слово до кросворду')
                ->modal('createWord')
                ->modalTitle('Додати слово до кросворду')
                ->method('createWord')
                ->parameters(['lesson_id'=>'crossword'])
                ->icon('plus'),
            Button::make(__('Зберегти зміни'))
                ->icon('save')
                ->confirm(__('Чи впевнені '))
                ->method('saveCrossword'),
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
            CrosswordEditLayout::class,
            WordsTableLayout::class,
            \Orchid\Support\Facades\Layout::modal('editWord',WordEditLayout::class)->async('asyncGetWord'),
            \Orchid\Support\Facades\Layout::modal('createWord',WordEditLayout::class),
        ];
    }


    public function asyncGetWord(Word $word)
    {
        return [
            'words' => $word,
        ];
    }

    public function action(): void
    {
        Toast::info('asdasd - ');
    }


    public function update(Word $words, Request $request): void
    {
        $data = Word::updateOrCreate(['id'=>$words->id],$request->get('words'));
        Toast::info('Оновлено елемент кросворду');
    }

    public function createWord(Crossword $crossword, Request $request){
        $words = new Word($request->get('words'));
        $crossword->word()->save($words);
        //$data = Word::created(['crossword_id'=>$crossword->id],$request->get('words'));
        Toast::info('Оновлено елемент кросворду');
    }

    public function saveCrossword(Crossword $crossword, Request $request){
        $data = Crossword::updateOrCreate(['id'=>$crossword->id], $request->get('crossword'));
        Toast::success('Зміни збережено');
    }

    public function removeWord(Request $request){
        Word::destroy($request->query('id'));
        Toast::success('Успішно видалено');
    }
}
