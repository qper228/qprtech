<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\db\Page */

if (!$model->sectionId) $model->sectionId = '';
if (!$model->orderNumber) $model->orderNumber = 0;

$form = ActiveForm::begin(['id' => 'page-form']);
?>

<div class="page-form">
    <?=
    $this->render('@app/modules/admin/views/_partials/_content_fields', [
        'form' => $form,
        'model' => $model,

        // Under-title content block (left column)
        'contentFields' => function($form, $model) {
            $out = '';
            // shortTitle + contentBottom are Page-specific
            $out .= $form->field($model, 'shortTitle')->textInput(['maxlength' => true]);
            $out .= $form->field($model, 'contentBottom')->widget(\kartik\editors\Summernote::class, [
                'pluginOptions' => ['disableHtmlSanitizer' => true],
            ]);
            return $out;
        },

        // Bottom of right column (side extras)
        'sideFields' => function($form, $model) {
            $out = '';
            $out .= $form->field($model, 'sectionId')->dropDownList(\app\models\db\Page::getSections());
            $out .= $form->field($model, 'isHomePage')->checkbox();
            $out .= $form->field($model, 'isBlogPage')->checkbox();
            $out .= $form->field($model, 'isVideoPage')->checkbox();
            return $out;
        },
    ]);
    ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'form' => 'page-form']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
