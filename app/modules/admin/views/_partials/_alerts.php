<?php

if (Yii::$app->session->hasFlash('recordCreated')) {
    echo '<div class="alert alert-success text-left">The record was created successfully</div>';
}
if (Yii::$app->session->hasFlash('recordUpdated')) {
    echo '<div class="alert alert-success text-left">The record was updated successfully</div>';
}
