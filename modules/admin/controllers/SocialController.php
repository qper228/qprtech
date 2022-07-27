<?php

namespace app\modules\admin\controllers;

use app\models\Social;
use app\models\SocialSearch;


class SocialController extends AbstractAdminController
{
    protected $model = Social::class;
    protected $searchModel = SocialSearch::class;
}
