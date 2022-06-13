<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    protected $vars = [];
    protected $template;
    protected $partials;
    protected $route;
    protected $content = false;
    protected $title = 'Admin Dashboard';

    protected $posts;
    protected $comments;

    /**
     * AdminController __construct
     */
    public function __construct()
    {
        //
    }

    /**
     * @return Application|Factory|View
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    /**
     * @param $result
     * @return RedirectResponse
     */
    protected function routeResolver($result): RedirectResponse
    {
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route($this->route)->with($result);
    }
}
