<?php
/** @var array $items */
/** @var string $email */
/** @var string $phone */
/** @var $logo */

use yii\helpers\Html;

?>

<div class="row">
    <div class="col-md-3">
        <?= Html::a($logo['label'], $logo['url']) ?>
        <div class="contacts">
            <p><?= Html::a('<i class="fa-solid fa-at"></i> '.$email, 'mailto:'.$email) ?></p>
            <p><?= Html::a('<i class="fa-solid fa-phone"></i> '.$phone, 'tel:'.$phone) ?></p>
        </div>
    </div>
    <div class="col-md-9">
        <div class="footer-links">
            <?php foreach ($items as $item) { ?>
                <div>
                    <h6 class="<?= $item['options']['class'] ?>">
                        <?= $item['url'] ? Html::a(
                            $item['label'],
                            $item['url'],
                            $item['linkOptions']
                        ) : $item['label'] ?>
                    </h6>
                    <?php
                        if ($item['items']) {
                            echo '<ul>';
                            foreach ($item['items'] as $i) {
                                echo '<li>'.Html::a($i['label'], $i['url'], $i['linkOptions']).'</li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>
            <?php }?>
        </div>
    </div>
</div>