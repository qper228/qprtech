<?php
/** @var $first_name */
/** @var $last_name */
/** @var $email */
/** @var $amount */


use yii\helpers\Html;


?>
<section>
    <div class="container text-center">
        <h2>Payment of $<?=$amount?></h2>
        <h3>Please, choose your payment method:</h3>
        <?=Html::a(Html::img('@web/img/default/paypal-btn.png', ['width' => 300]), 'https://backend.coin-college.com/processing/paypal-checkout?first_name='.$first_name.'&last_name='.$last_name.'&email='.$email.'&amount='.$amount, [
            'class' => 'payment-button'
        ]) ?>
    </div>
</section>
<div id="loader" class="d-none">
    <?=Html::img('@web/img/default/loader.svg')?>
</div>