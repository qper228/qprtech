<?php
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var yii\db\ActiveRecord $model
 * @var null|callable $contentFields // function(ActiveForm $form, $model): string
 * @var null|callable $sideFields    // function(ActiveForm $form, $model): string
 */

use kartik\editors\Codemirror;
use kartik\editors\Summernote;

// Some models might not have these attributes; guard with property_exists()
$hasAttr = fn($attr) => property_exists($model, $attr) || $model->canSetProperty($attr);
?>

<div class="row">
    <div class="col-md-9">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php if ($hasAttr('content')): ?>
            <?= $form->field($model, 'content')->widget(Summernote::class, [
                'pluginOptions' => ['disableHtmlSanitizer' => true],
            ]) ?>
        <?php endif; ?>

        <?php
        // Inject model-specific content fields right UNDER the title
        if (is_callable($contentFields)) {
            echo call_user_func($contentFields, $form, $model);
        }
        ?>

        <div class="row">
            <div class="col-md-6">
                <?php if ($hasAttr('headScript')): ?>
                    <?= $form->field($model, 'headScript')->widget(Codemirror::class, [
                        'useKrajeePresets' => true,
                    ]) ?>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if ($hasAttr('bodyScript')): ?>
                    <?= $form->field($model, 'bodyScript')->widget(Codemirror::class, [
                        'useKrajeePresets' => true,
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <?php if ($hasAttr('slug')): ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?php endif; ?>

        <?php if ($hasAttr('languageId')): ?>
            <?= $form->field($model, 'languageId')->dropDownList(\app\models\db\Language::getList()) ?>
        <?php endif; ?>

        <?php if ($hasAttr('orderNumber')): ?>
            <?= $form->field($model, 'orderNumber')->textInput(['type' => 'number']) ?>
        <?php endif; ?>

        <?php if ($hasAttr('file')): ?>
            <?= $form->field($model, 'file')->fileInput() ?>
        <?php endif; ?>

        <?php if (!$model->isNewRecord && $hasAttr('image') && !empty($model->image)) {
            // Assuming your model’s image() helper renders an <img>
            echo $model->image('100%');
        } ?>

        <?php if ($hasAttr('metaTitle')): ?>
            <?= $form->field($model, 'metaTitle')->textInput(['maxlength' => true]) ?>
        <?php endif; ?>
        <?php if ($hasAttr('metaDescription')): ?>
            <?= $form->field($model, 'metaDescription')->textarea(['rows' => 3]) ?>
        <?php endif; ?>
        <?php if ($hasAttr('keywords')): ?>
            <?= $form->field($model, 'keywords')->textarea(['rows' => 3]) ?>
        <?php endif; ?>

        <?php if ($hasAttr('isIndex')): ?>
            <?= $form->field($model, 'isIndex')->checkbox() ?>
        <?php endif; ?>
        <?php if ($hasAttr('isFollow')): ?>
            <?= $form->field($model, 'isFollow')->checkbox() ?>
        <?php endif; ?>
        <?php if ($hasAttr('isHidden')): ?>
            <?= $form->field($model, 'isHidden')->checkbox() ?>
        <?php endif; ?>

        <?php
        // Inject model-specific SIDE extras at the bottom of the right column
        if (is_callable($sideFields)) {
            echo call_user_func($sideFields, $form, $model);
        }
        ?>
    </div>
</div>
