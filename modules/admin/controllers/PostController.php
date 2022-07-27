<?php

namespace app\modules\admin\controllers;

use app\models\Post;
use app\models\PostSearch;


class PostController extends AbstractAdminController
{
    protected $model = Post::class;
    protected $searchModel = PostSearch::class;
}
