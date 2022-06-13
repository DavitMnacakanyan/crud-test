<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\PostRepository as PostR;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class PostController extends AdminController
{
    /**
     * @param PostR $posts
     */
    public function __construct(PostR $posts)
    {
        parent::__construct();

        $this->posts = $posts;
        $this->template = baseDirPath() . '.admin.index.index';
        $this->partials = baseDirPath() . '.admin.index';
        $this->route = 'admin.posts.index';
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = $this->posts->withPaginatePost();

        $this->content = view("{$this->partials}.index_content",
            compact('posts')
        )->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->content = view("{$this->partials}.index_create_update_content")
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $result = $this->posts->createPost($request);

        return $this->routeResolver($result);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $this->content = view("{$this->partials}.index_create_update_content",
            compact('post')
        )->render();

        return $this->renderOutput();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $result = $this->posts->updatePost($request, $post);

        return $this->routeResolver($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $result = $this->posts->deletePost($post);

        return $this->routeResolver($result);
    }
}
