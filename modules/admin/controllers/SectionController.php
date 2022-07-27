<?php

namespace app\modules\admin\controllers;

use app\models\Section;
use app\models\SectionSearch;


class SectionController extends AbstractAdminController
{
    protected $model = Section::class;
    protected $searchModel = SectionSearch::class;
}
