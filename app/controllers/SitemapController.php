<?php

namespace app\controllers;

use app\models\db\BlogCategory;
use app\models\db\BlogSubcategory;
use app\models\db\Page;
use app\models\db\Post;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_XML;
        \Yii::$app->response->headers->add('Content-Type', 'application/xml');

        $urls = [
            [
                'loc' => Url::to(['site/index'], true),
                'changefreq' => 'daily',
                'priority' => 1.0,
            ],
            [
                'loc' => Url::to(['site/blog'], true),
                'changefreq' => 'daily',
                'priority' => 0.9,
            ],
        ];

        // Static pages
        foreach (Page::findAll(['isHidden' => false, 'isHomePage' => false, 'isBlogPage' => false]) as $page) {
            $urls[] = [
                'loc' => Url::to(['site/page', 'slug' => $page->slug], true),
                'changefreq' => 'monthly',
                'priority' => 0.7,
            ];
        }

        // Categories (non-hidden) + their subcategories (non-hidden)
        $categories = BlogCategory::find()->where(['isHidden' => false])->all();

        foreach ($categories as $cat) {
            // Category URL
            $urls[] = [
                'loc' => Url::to(['site/blog', 'category' => $cat->slug], true),
                'changefreq' => 'daily',
                'priority' => 0.8,
            ];

            // Subcategory URLs under this category
            $subs = $cat->getSubcategories()
                ->andWhere(['isHidden' => false])
                ->all();

            foreach ($subs as $sub) {
                $urls[] = [
                    'loc' => Url::to([
                        'site/blog',
                        'category'    => $cat->slug,
                        'subcategory' => $sub->slug,
                    ], true),
                    'changefreq' => 'daily',
                    'priority' => 0.75,
                ];
            }
        }

        // Blog posts
        foreach (Post::findAll(['isHidden' => false]) as $post) {
            $urls[] = [
                'loc' => Url::to(['site/post', 'slug' => $post->slug], true),
                'changefreq' => 'weekly',
                'priority' => 0.8,
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= "  <url>" . PHP_EOL;
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>" . PHP_EOL;
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>" . PHP_EOL;
            $xml .= "    <priority>{$url['priority']}</priority>" . PHP_EOL;
            $xml .= "  </url>" . PHP_EOL;
        }

        $xml .= '</urlset>';

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'application/xml; charset=UTF-8');
        return $xml;
    }
}