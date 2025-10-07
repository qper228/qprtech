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
use app\models\db\BlogSubcategory;

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
        $apiKey  = Yii::$app->params['apiKey'];

        $headerKey = $request->headers->get('X-Api-Key');
        if ($headerKey !== $apiKey) {
            throw new ForbiddenHttpException('Invalid API key');
        }

        $title           = $request->post('title');
        $preview         = $request->post('preview');
        $content         = $request->post('content');
        $categoryLabel   = $request->post('category');     // required
        $subcategoryName = trim((string)$request->post('subcategory', '')); // optional
        $languageShortcut = $request->post('language');

        if (!$title || !$preview || !$content || !$categoryLabel || !$languageShortcut) {
            throw new BadRequestHttpException('Missing required fields.');
        }

        $language = Language::findOne(['shortcut' => $languageShortcut]);
        if (!$language) {
            throw new BadRequestHttpException('Invalid language shortcut.');
        }

        // --- Category: find by label, or create ---
        $category = BlogCategory::findOne(['label' => $categoryLabel]);
        if (!$category) {
            $slugger = new Slugger();
            $slug = $slugger->slugify($categoryLabel);
            $category = new BlogCategory([
                'label'      => $categoryLabel,
                'slug'       => $slug,
                'languageId' => $language->id,
            ]);
            if (!$category->save()) {
                return ['success' => false, 'errors' => ['category' => $category->errors]];
            }
        }

        // --- Subcategory: optional; find within this category by slug OR title, or create ---
        $subcategory = null;
        if ($subcategoryName !== '') {
            $slugger = new Slugger();
            $subSlug = $slugger->slugify($subcategoryName);

            $subcategory = BlogSubcategory::find()
                ->where(['categoryId' => $category->id])
                ->andWhere(['or', ['slug' => $subSlug], ['title' => $subcategoryName]])
                ->one();

            if (!$subcategory) {
                $subcategory = new BlogSubcategory([
                    'categoryId' => $category->id,
                    'title'      => $subcategoryName,
                    'slug'       => $subSlug,
                    // Optional: set language explicitly; will inherit from category if omitted
                    'languageId' => $language->id,
                ]);
                if (!$subcategory->save()) {
                    return ['success' => false, 'errors' => ['subcategory' => $subcategory->errors]];
                }
            }
        }

        // --- Create the Post ---
        $post = new Post();
        $post->title       = $title;
        $post->preview     = $preview;
        $post->content     = $content;
        $post->languageId  = $language->id;
        $post->file        = UploadedFile::getInstanceByName('file');

        if ($subcategory) {
            // keep things consistent if you still store categoryId on Post
            $post->subcategoryId = $subcategory->id;
            $post->categoryId    = $subcategory->categoryId;
        } else {
            $post->categoryId    = $category->id;
        }

        if ($post->save()) {
            return [
                'success'        => true,
                'id'             => $post->id,
            ];
        }

        return ['success' => false, 'errors' => $post->errors];
    }

}