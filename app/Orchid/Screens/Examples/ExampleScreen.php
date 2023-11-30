<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Crossword;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\Topic;
use App\Models\User;
use App\Models\Water;
use App\Orchid\Layouts\Chart\WaterChart;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ExampleScreen extends Screen
{
    /**
     * Fish text for the table.
     */
    public const TEXT_EXAMPLE = 'Lorem ipsum at sed ad fusce faucibus primis, potenti inceptos ad taciti nisi tristique
    urna etiam, primis ut lacus habitasse malesuada ut. Lectus aptent malesuada mattis ut etiam fusce nec sed viverra,
    semper mattis viverra malesuada quam metus vulputate torquent magna, lobortis nec nostra nibh sollicitudin
    erat in luctus.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {

        $data = [];
        foreach (User::where('id','<','10')->get() as $user){
            $data[] = [
                'name'   => $user->name.' '.$user->surname,
                'values' => [$user->water,$user->lumen],
                'labels' => ['Вода','Проміння'],
            ];
        }

        return [




            'charts'  => [
                [
                    'name'   => 'Кросворд',
                    'values' => [25, 40],
                    'labels' => ['Правильні відповіді', 'Неправильні спроби'],
                ],
//                [
//                    'name'   => 'Another Set',
//                    'values' => [25, 50, -10, 15, 18, 32, 27],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
//                [
//                    'name'   => 'Yet Another',
//                    'values' => [15, 20, -3, -15, 58, 12, -17],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
//                [
//                    'name'   => 'And Last',
//                    'values' => [10, 33, -8, -3, 70, 20, -34],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
            ],
            'table'   => [
                new Repository(['id' => 100, 'name' => self::TEXT_EXAMPLE, 'price' => 10.24, 'created_at' => '01.01.2020']),
                new Repository(['id' => 200, 'name' => self::TEXT_EXAMPLE, 'price' => 65.9, 'created_at' => '01.01.2020'])

            ],
            'metrics' => [
                'crosswords'    => number_format(count(Crossword::all())),
                'tests' => number_format(count(Question::all())),
                'lessons'   =>number_format(count(Lessons::all())),
                'users'    => number_format(count(User::all())),
                'topic'    => number_format(count(Topic::all())),
            ],
            'water' => $data
        ];


    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Домашня сторінка';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Монітор сайту';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make('Show toast')
                ->method('showToast')
                ->novalidate()
                ->icon('bag'),

            ModalToggle::make('Launch demo modal')
                ->modal('exampleModal')
                ->method('showToast')
                ->icon('full-screen'),

            Button::make('Export file')
                ->method('export')
                ->icon('cloud-download')
                ->rawClick()
                ->novalidate(),

            DropDown::make('Dropdown button')
                ->icon('folder-alt')
                ->list([

                    Button::make('Action')
                        ->method('showToast')
                        ->icon('bag'),

                    Button::make('Another action')
                        ->method('showToast')
                        ->icon('bubbles'),

                    Button::make('Something else here')
                        ->method('showToast')
                        ->icon('bulb'),

                    Button::make('Confirm button')
                        ->method('showToast')
                        ->confirm('If you click you will see a toast message')
                        ->novalidate()
                        ->icon('shield'),
                ]),

        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Кількість кросвордів'      => 'metrics.crosswords',
                'Кількість тестів'          => 'metrics.tests',
                'Кількість уроків'          => 'metrics.lessons',
                'Кількість користувачів'    => 'metrics.users',
                'Кількість курсів'          => 'metrics.topic',
            ]),

            Layout::columns([
                ChartLineExample::class,
                ChartBarExample::class,
            ]),

            Layout::columns([
                WaterChart::class,
            ]),

            Layout::table('table', [
                TD::make('id', 'ID')
                    ->width('150')
                    ->render(function (Repository $model) {
                        // Please use view('path')
                        return "<img src='https://picsum.photos/450/200?random={$model->get('id')}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$model->get('id')}</span>";
                    }),

                TD::make('name', 'Name')
                    ->width('450')
                    ->render(function (Repository $model) {
                        return Str::limit($model->get('name'), 200);
                    }),

                TD::make('price', 'Price')
                    ->render(function (Repository $model) {
                        return '$ '.number_format($model->get('price'), 2);
                    }),

                TD::make('created_at', 'Created'),
            ]),

            Layout::modal('exampleModal', Layout::rows([
                Input::make('toast')
                    ->title('Messages to display')
                    ->placeholder('Hello world!')
                    ->help('The entered text will be displayed on the right side as a toast.')
                    ->required(),
            ]))->title('Create your own toast message'),
        ];
    }

    /**
     * @param Request $request
     */
    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        return response()->streamDownload(function () {
            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                fputcsv($csv, ['header:col1', 'header:col2', 'header:col3']);
            });

            collect([
                ['row1:col1', 'row1:col2', 'row1:col3'],
                ['row2:col1', 'row2:col2', 'row2:col3'],
                ['row3:col1', 'row3:col2', 'row3:col3'],
            ])->each(function (array $row) use ($csv) {
                fputcsv($csv, $row);
            });

            return tap($csv, function ($csv) {
                fclose($csv);
            });
        }, 'File-name.csv');
    }
}
