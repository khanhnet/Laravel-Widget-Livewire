<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Todo;

class RecentTodos extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    public $reloadTimeout = 10;
    protected $config = [
        'count' => 5,
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.recent_todos', [
            'config' => $this->config,
            'todosNew' => Todo::take($this->config["count"])->orderBy('id','desc')->get(),
        ]);
    }
}
