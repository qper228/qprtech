<?php

namespace app\modules\admin\controllers;

use app\models\db\Video;
use app\models\search\VideoSearch;

class VideoController extends AbstractAdminController
{
    protected $model = Video::class;
    protected $searchModel = VideoSearch::class;
}
