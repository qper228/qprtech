<?php

namespace app\modules\admin\controllers;

use app\models\db\Post;
use app\models\search\PostSearch;


class PostController extends AbstractAdminController
{
    protected $model = Post::class;
    protected $searchModel = PostSearch::class;
}
