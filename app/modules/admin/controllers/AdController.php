<?php

namespace app\modules\admin\controllers;

use app\models\db\Ad;
use app\models\search\AdSearch;

/**
 * BlogCategoryController implements the CRUD actions for BlogCategory model.
 */
class AdController  extends AbstractAdminController
{
    protected $model = Ad::class;
    protected $searchModel = AdSearch::class;
}
