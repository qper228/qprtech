<?php

namespace app\modules\admin\controllers;

use app\models\db\User;
use app\models\search\UserSearch;


class UserController extends AbstractAdminController
{
    protected $searchModel = UserSearch::class;
    protected $model = User::class;
}
