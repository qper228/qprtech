<?php

namespace app\modules\admin\controllers;

use app\models\db\Settings;
use app\models\search\SettingsSearch;


class SettingsController extends AbstractAdminController
{
    protected $model = Settings::class;
    protected $searchModel = SettingsSearch::class;
}
