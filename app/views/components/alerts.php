<?php
if (Yii::$app->session->hasFlash('leadSubmitted')) {
    echo '<div class="alert alert-success text-center">🎉 Thank you for subscribing!</div>';
}
if (Yii::$app->session->hasFlash('contactFormSubmitted')) {
    echo '<div class="alert alert-success text-center">Thank you for contacting us. We will respond to you as soon as possible.</div>';
}