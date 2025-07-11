<?php
/** @var yii\web\View $this */
/** @var $posts */
/** @var $title */
/** @var $sort */

use yii\helpers\Html;

?>
<div class="mb-5">
    <div class="d-flex justify-content-between mb-2">
        <h2><?= $title ?></h2>
        <div class="d-none d-sm-block">
            <?= Html::a('All '.$title, ['site/blog', 'orderBy' => $sort]) ?>
        </div>
    </div>
    <div class="row">
        <?php
        foreach ($posts as $post) {
            echo Html::tag(
                'div',
                    Html::a(
                    $this->render('@app/views/components/post', [
                        'model' => $post,
                        'size' => 'md'
                    ]),
                    ['site/post', 'slug' => $post->slug]
                ),
                ['class' => 'col-md-4']
            );
        }
        ?>
    </div>
    <div class="d-block d-sm-none text-center">
        <?= Html::a('All '.$title, ['site/blog', 'orderBy' => $sort], ['class' => 'btn btn-lg btn-link']) ?>
    </div>
</div>
