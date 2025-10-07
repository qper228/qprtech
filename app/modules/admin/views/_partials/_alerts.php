<?php

if (Yii::$app->session->hasFlash('recordCreated')) {
    echo '<div class="alert alert-success text-left">The record was created successfully</div>';
}
if (Yii::$app->session->hasFlash('recordUpdated')) {
    echo '<div class="alert alert-success text-left">The record was updated successfully</div>';
}
if (Yii::$app->session->hasFlash('success')) {
    echo '<div class="alert alert-success text-left">'.Yii::$app->session->getFlash('success').'</div>';
}

if (Yii::$app->session->hasFlash('error')) {
    echo '<div class="alert alert-danger text-left">'.Yii::$app->session->getFlash('error').'</div>';
}
