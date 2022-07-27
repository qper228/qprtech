<?php

namespace app\modules\admin\controllers;

use app\models\Settings;
use app\models\SettingsSearch;


class SettingsController extends AbstractAdminController
{
    protected $model = Settings::class;
    protected $searchModel = SettingsSearch::class;
}
