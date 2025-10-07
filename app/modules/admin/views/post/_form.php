<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\db\BlogCategory;
use app\models\db\BlogSubcategory; // <-- add this

/* @var $this yii\web\View */
/* @var $model \app\models\db\Post */

$form = ActiveForm::begin();
?>

<div class="post-form">
    <?= $this->render('@app/modules/admin/views/_partials/_content_fields', [
        'form' => $form,
        'model' => $model,

        'contentFields' => function($form, $model) {
            $out = '';
            $out .= $form->field($model, 'preview')->textarea(['rows' => 3]);
            return $out;
        },

        'sideFields' => function($form, $model) {
            $out  = $form->field($model, 'categoryId')->dropDownList(
                BlogCategory::getList(),
                ['prompt' => 'Select category'] // optional
            );

            // Initial subcategory list for edit-mode; empty for create
            $subItems = $model->categoryId
                ? BlogSubcategory::getList($model->categoryId)
                : [];

            $out .= $form->field($model, 'subcategoryId')->dropDownList(
                $subItems,
                [
                    'prompt'   => 'Select subcategory',
                    'disabled' => !$model->categoryId, // enabled when category chosen
                ]
            );

            $out .= $form->field($model, 'views')->textInput(['type' => 'number']);
            $out .= $form->field($model, 'isEditorsPick')->checkbox();
            return $out;
        },
    ]); ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php
// --- Dependent dropdown wiring ---
$catInputId = Html::getInputId($model, 'categoryId');
$subInputId = Html::getInputId($model, 'subcategoryId');
$url        = Url::to(['/admin/blog-subcategory/options']);
$selected   = $model->subcategoryId ? (string)$model->subcategoryId : '';

$js = <<<JS
(function(){
  var \$cat = $('#{$catInputId}');
  var \$sub = $('#{$subInputId}');
  var selectedOnLoad = '{$selected}';

  function setDisabled(state){ \$sub.prop('disabled', state); }

  function loadSubs(selected) {
    var catId = \$cat.val();
    if (!catId) {
      \$sub.html('<option value="">Select subcategory</option>');
      setDisabled(true);
      return;
    }
    setDisabled(true);
    \$sub.html('<option value="">Loading…</option>');
    $.get('{$url}', {categoryId: catId}, function(resp){
      if (resp && typeof resp.options !== 'undefined') {
        \$sub.html('<option value="">Select subcategory</option>' + resp.options);
        setDisabled(false);
        if (selected) { \$sub.val(String(selected)); }
      } else {
        \$sub.html('<option value="">—</option>');
      }
    });
  }

  // Initial population for edit mode
  if (\$cat.val()) { loadSubs(selectedOnLoad); }

  // On category change
  \$cat.on('change', function(){
    \$sub.val('');
    loadSubs(null);
  });
})();
JS;

$this->registerJs($js);
?>

<?php ActiveForm::end(); ?>
