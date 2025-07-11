<?php
/** @var yii\web\View $this */
/** @var $posts */

use yii\helpers\Html;

$lastPost = array_shift($posts);
?>
<div class="mb-5">
    <h2>Latest Articles</h2>
    <div class="row">
        <div class="col-md-4">
            <?php if ($lastPost) {
                echo Html::a(
                    $this->render('@app/views/components/post', [
                        'model' => $lastPost,
                        'size' => 'md'
                    ]), ['site/post', 'slug' => $lastPost->slug]
                );
            } ?>
            <div class="d-block d-sm-none text-center">
                <?= Html::a('All Latest Articles', ['site/blog'], ['class' => 'btn btn-lg btn-link']) ?>
            </div>
        </div>
        <div class="col-md-5 d-none d-sm-flex flex-sm-column gap-sm-3 border-right">
            <?php
            foreach ($posts as $post) {
                echo Html::a($this->render('post_preview', ['post' => $post]), ['site/post', 'slug' => $post->slug]);
            }
            echo Html::a('All Latest Articles', ['site/blog'], ['class' => 'btn btn-lg btn-link']);
            ?>
        </div>
        <div class="col-md-3">
            <?= $this->render('@app/views/components/ad', [
                'slot' => 'right-latest'
            ]) ?>
        </div>
    </div>
</div>