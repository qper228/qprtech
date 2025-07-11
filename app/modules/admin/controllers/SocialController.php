<?php

namespace app\modules\admin\controllers;

use app\models\db\Social;
use app\models\search\SocialSearch;


class SocialController extends AbstractAdminController
{
    protected $model = Social::class;
    protected $searchModel = SocialSearch::class;
}
