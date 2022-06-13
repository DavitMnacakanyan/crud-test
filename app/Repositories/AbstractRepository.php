<?php

namespace App\Repositories;

use App\Models\Image;
use JetBox\Repositories\Eloquent\AbstractRepository as BaseRepository;

abstract class AbstractRepository extends BaseRepository
{
    /**
     * @param string $imageName
     * @param object $model
     * @return void
     */
    public function imageSave(string $imageName, object $model)
    {
        $imageObj = new Image();
        $imageObj->name = $imageName;
        $imageObj->imageable_type = $this->model;
        $imageObj->imageable_id = $model->id;
        $imageObj->save();
    }
}
