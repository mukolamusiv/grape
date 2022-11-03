<?php

namespace App\Orchid\Screens\Question;

use App\Models\Question;
use App\Orchid\Layouts\Question\QuestionEditLayout;
use App\Orchid\Layouts\Question\QuestionTableLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use function Termwind\ValueObjects\block;

class QuestionScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'questions'=>Question::all()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Тести для уроків';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати запитання')
                ->modal('createQuestion')
                ->modalTitle('Додавання нового запитання')
                ->method('createQuestion')
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
            QuestionTableLayout::class,
            \Orchid\Support\Facades\Layout::modal('createQuestion',QuestionEditLayout::class),
//            \Orchid\Support\Facades\Layout::block(QuestionTableLayout::class)
//                ->title('Відповіді')
//                ->description('Усі відповіді до запитань'),
        ];
    }

    public function createQuestion(Request $request){
        $data = new Question($request->get('question'));
        if($data->save()){
            Toast::success('Додано нове запитання');
            return redirect(route('question.edit',$data->id));
        }else{
            Toast::error('Щось пішло не так');
            return redirect(route('question.list'));
        }
        //Question::created($request->get(''));
    }

    public function removeQuestion(Request $request){
        Question::destroy($request->get('id'));
        Toast::success('Видалено запитання');
        return redirect(route('question.list'));
    }
}
