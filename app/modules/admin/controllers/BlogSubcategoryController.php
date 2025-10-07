<?php

namespace app\modules\admin\controllers;

use app\models\db\BlogSubcategory;
use app\models\search\BlogSubcategorySearch;
use yii\helpers\Html;
use yii\web\Response;

/**
 * BlogCategoryController implements the CRUD actions for BlogCategory model.
 */
class BlogSubcategoryController  extends AbstractAdminController
{
    protected $model = BlogSubcategory::class;
    protected $searchModel = BlogSubcategorySearch::class;

    public function actionOptions($categoryId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $categoryId = (int) $categoryId;
        $list = $categoryId ? BlogSubcategory::getList($categoryId) : [];

        // Render plain <option> tags; client will inject into the <select>
        return [
            'options' => Html::renderSelectOptions(null, $list),
        ];
    }
}
