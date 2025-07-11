<?php
/** @var array $items */
/** @var string $email */
/** @var string $phone */
/** @var string $contacts */
/** @var string $socials */
/** @var string $copyright */
/** @var string $footerText */
/** @var object $settings */
/** @var $logo */

use yii\helpers\Html;
$chunks = array_chunk($items, 4);
?>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?= Html::a($logo['label'], $logo['url']) ?>
                <?= $contacts ?>
            </div>
            <div class="col-md-9 d-flex justify-content-md-end justify-content-start align-items-start">
                <div class="footer-links d-flex">
                    <?php foreach ($chunks as $chunk) { ?>
                        <ul class="list-unstyled mr-4">
                            <?php foreach ($chunk as $item) { ?>
                                <li>
                                    <?= Html::a(
                                        $item['label'],
                                        $item['url'],
                                        $item['linkOptions']
                                    ) ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?= $socials ?>
        <div class="footer-disclaimer">
            <?= $footerText ?>
        </div>
        <?= $copyright ?>
    </div>
</footer>
