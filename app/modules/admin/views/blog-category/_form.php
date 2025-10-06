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
    ]);
    ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
