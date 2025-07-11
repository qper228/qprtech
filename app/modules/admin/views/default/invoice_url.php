<?php

use kartik\editors\Codemirror;
use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $url */
$this->title = 'Generate invoice';
?>

<?=Html::textInput('url', $url, ['class' => 'form-control'])?>
<?=Html::a('Back', ['default/invoice'], ['class' => 'btn btn-default'])?>
