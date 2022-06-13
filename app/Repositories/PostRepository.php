<?php

namespace App\Repositories;

use App\Constants\AppConstants;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Throwable;
use Illuminate\Support\Facades\DB;
use JetBox\Repositories\Support\Facades\JetBoxFile;

class PostRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $model = Post::class;

    /**
     * @return mixed
     */
    public function withPaginatePost()
    {
        $posts = $this->withPaginate(
            'images',
            ['*'],
            AppConstants::POSTS_PAGINATION_COUNT
        );

        return $posts;
    }

    /**
     * @param object $request
     * @return void
     * @throws Throwable
     */
    public function createPost(object $request): array
    {
        $data = $request->all();
        $img = $request->file('image');

        try {
            DB::beginTransaction();

            $post = tap($this->newModel()->fill($data))->save();

            if (!is_null($img)) {
                $imageName = JetBoxFile::save('posts', $img);
                $this->imageSave($imageName, $post);
            }

            DB::commit();
            return ['status' => 'Post was created successfully'];
        } catch (Throwable $exception) {
            DB::rollBack();
            return ['error' => "DB Error Code - {$exception->getCode()}"];
        }
    }

    /**
     * @param object $request
     * @param Post $post
     * @return string[]
     */
    public function updatePost(object $request, Post $post): array
    {
        $data = $request->all();
        $img = $request->file('image');

        try {
            DB::beginTransaction();

            $post->fill($data)->update();

            if (!is_null($img)) {
                $imageName = JetBoxFile::save('posts', $img);
                $this->imageSave($imageName, $post);
            }

            DB::commit();
            return ['status' => 'Post was updated successfully'];
        } catch (Throwable $exception) {
            DB::rollBack();
            return ['error' => "DB Error Code - {$exception->getCode()}"];
        }
    }

    /**
     * @param Post $post
     * @return string[]
     */
    public function deletePost(Post $post): array
    {
        try {
            DB::beginTransaction();

            foreach ($post->images as $image) {
                JetBoxFile::delete($image, 'name', 'posts');
            }
            $post->images()->delete();
            $post->delete();

            DB::commit();
            return ['status' => 'Post was deleted successfully'];
        } catch (Throwable $exception) {
            DB::rollBack();
            return ['error' => "DB Error Code - {$exception->getCode()}"];
        }
    }
}
