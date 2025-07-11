<?php

namespace app\controllers;

use app\models\db\Language;
use Sunrise\Slugger\Slugger;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use app\models\db\Post;
use app\models\db\BlogCategory;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionPost()
    {
        $request = Yii::$app->request;
        $apiKey = Yii::$app->params['apiKey'];

        $headerKey = $request->headers->get('X-Api-Key');
        if ($headerKey !== $apiKey) {
            throw new ForbiddenHttpException('Invalid API key');
        }

        $title = $request->post('title');
        $preview = $request->post('preview');
        $content = $request->post('content');
        $categoryLabel = $request->post('category');
        $languageShortcut = $request->post('language');

        if (!$title || !$preview || !$content || !$categoryLabel || !$languageShortcut) {
            throw new BadRequestHttpException('Missing required fields.');
        }

        $language = Language::findOne(['shortcut' => $languageShortcut]);
        if (!$language) {
            throw new BadRequestHttpException('Invalid language shortcut.');
        }

        $category = BlogCategory::findOne(['label' => $categoryLabel]);
        if (!$category) {
            $slugger = new Slugger();
            $slug = $slugger->slugify($categoryLabel);
            $category = new BlogCategory([
                'label' => $categoryLabel,
                'slug' => $slug,
            ]);
            if (!$category->save()) {
                return ['success' => false, 'errors' => $category->errors];
            }
        }

        $post = new Post();
        $post->title = $title;
        $post->preview = $preview;
        $post->content = $content;
        $post->categoryId = $category->id;
        $post->languageId = $language->id;
        $post->file = UploadedFile::getInstanceByName('file');

        if ($post->save()) {
            return ['success' => true, 'id' => $post->id];
        }

        return ['success' => false, 'errors' => $post->errors];
    }
}