<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\models\UserSearch;


class UserController extends AbstractAdminController
{
    protected $searchModel = UserSearch::class;
    protected $model = User::class;
}
