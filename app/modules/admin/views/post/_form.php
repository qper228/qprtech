<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\db\BlogCategory;
use app\models\db\Language;

/* @var $this yii\web\View */
/* @var $model \app\models\db\Post */

$form = ActiveForm::begin();
?>

<div class="post-form">
    <?=
    $this->render('@app/modules/admin/views/_partials/_content_fields', [
        'form' => $form,
        'model' => $model,

        // Under-title left column
        'contentFields' => function($form, $model) {
            $out = '';
            $out .= $form->field($model, 'preview')->textarea(['rows' => 3]);
            // Post does NOT have contentBottom/shortTitle by default, so we skip here.
            return $out;
        },

        // Bottom of right column
        'sideFields' => function($form, $model) {
            $out  = $form->field($model, 'categoryId')->dropDownList(BlogCategory::getList());
            $out .= $form->field($model, 'views')->textInput(['type' => 'number']);
            $out .= $form->field($model, 'isEditorsPick')->checkbox();
            return $out;
        },
    ]);
    ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
