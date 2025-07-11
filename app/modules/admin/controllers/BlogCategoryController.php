<?php

namespace app\modules\admin\controllers;

use app\models\db\BlogCategory;
use app\models\search\BlogCategorySearch;

/**
 * BlogCategoryController implements the CRUD actions for BlogCategory model.
 */
class BlogCategoryController  extends AbstractAdminController
{
    protected $model = BlogCategory::class;
    protected $searchModel = BlogCategorySearch::class;
}
