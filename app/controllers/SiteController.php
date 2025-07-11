<?php

namespace app\controllers;

use app\models\db\BlogCategory;
use app\models\db\Language;
use app\models\db\Page;
use app\models\db\Post;
use app\models\db\Section;
use app\models\db\Settings;
use app\models\db\Social;
use app\models\db\Video;
use app\models\forms\ContactForm;
use app\models\forms\LeadForm;
use app\models\forms\LoginForm;
use app\models\search\PostSearch;
use app\models\search\VideoSearch;
use app\widgets\Contacts;
use app\widgets\Copyright;
use app\widgets\Socials;
use GuzzleHttp\Client;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap4\ButtonDropdown;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class SiteController extends Controller {
    public $language;
    public $settings;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function __construct($id, $module, $config = []) {
        $session = Yii::$app->session;
        $language = $session->get('language', Language::findOne(['isDefault' => true])->shortcut);
        $this->language = Language::findOne(['shortcut' => $language]);
        $settings = Settings::getActive($language);
        if (!$settings) throw new InvalidConfigException('You have to create `Settings` record for this language');
        $this->settings = $settings;

        Yii::$app->view->params['language'] = $language;
        Yii::$app->view->params['favicon'] = $settings->favicon;
        Yii::$app->view->params['header'] = $this->getHeader();
        Yii::$app->view->params['footer'] = $this->getFooter();
        Yii::$app->view->params['console'] = $this->debug();
        Yii::$app->view->params['headScript'] = $settings->headScript;
        Yii::$app->view->params['bodyScript'] = $settings->bodyScript;
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $latestPosts = Post::find()
            ->orderBy(['createdAt' => SORT_DESC])
            ->limit(5)
            ->all();
        $popularPosts = Post::find()
            ->orderBy(['views' => SORT_DESC])
            ->limit(3)
            ->all();
        $editorsPosts = Post::find()
            ->orderBy(['isEditorsPick' => SORT_DESC])
            ->limit(3)
            ->all();
        $featuredPath = Yii::getAlias('@webroot/img/featured');
        $featured = $this->getDirectoryContents($featuredPath);
        $videos = Video::find()
            ->orderBy(['createdAt' => SORT_DESC])
            ->limit(3)
            ->all();

        $page = Page::findOne(['isHomePage' => true]);
        $context = array_merge(
            $this->getPageContext($page),
            [
                'latestPosts' => $latestPosts,
                'popularPosts' => $popularPosts,
                'editorsPosts' => $editorsPosts,
                'featured' => $featured,
                'videos' => $videos,
                'model' => $page
            ]
        );
        return $this->render('home/index', $context);
    }

    public function actionBlog($category='', $search = '', $orderBy='createdAt') {
        $query = Post::find()->orderBy([$orderBy => SORT_DESC]);
        if ($category) {
            $query
                ->joinWith('category')
                ->andFilterWhere(['blog_categories.slug' => $category]);
        }
        if ($search) {
            $query->andWhere(['or',
                ['like', 'title', $search],
                ['like', 'content', $search],
            ]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);
        $pagination = $dataProvider->pagination;
        $models = $dataProvider->getModels();

        $page = Page::findOne(['isBlogPage' => true]);
        $categories = BlogCategory::find()->all();
        $context = array_merge(
            $this->getPageContext($page),
            [
                'models' => $models,
                'categories' => $categories,
                'pagination' => $pagination,
                'categorySlug' => $category,
                'orderBy' => $orderBy,
                'model' => $page
            ]
        );
        if (Yii::$app->request->isPjax) {
            return $this->renderPartial('blog/index', $context);
        }
        return $this->render('blog/index', $context);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSwitchLang($lang){
        $session = Yii::$app->session;
        $session->remove('language');
        $session->set('language', $lang);
        $locale = $session->get('language', $lang);
        $this->language = $locale;
        Yii::$app->view->params['language'] = $locale;
        return $this->goHome();
    }

    public function actionPage($slug)
    {
        $page = Page::findOne([
            'slug' => $slug,
            'languageId' => $this->language->id
        ]);
        if (!$page) throw new NotFoundHttpException('The requested page does not exist.');
        Yii::$app->view->params['breadcrumbs'][] = $page->title;
        return $this->render('page', [
            'model' => $page,
            'settings' => $this->settings
        ]);
    }

    public function actionPost($slug)
    {
        $post = Post::findOne([
            'slug' => $slug,
            'languageId' => $this->language->id
        ]);
        if (!$post) throw new NotFoundHttpException('The requested page does not exist.');
        $post->views += 1;
        $post->save();
        Yii::$app->view->params['breadcrumbs'][] = Html::a('Blog', '/blog');
        Yii::$app->view->params['breadcrumbs'][] = $post->title;
        return $this->render('post', [
            'model' => $post,
            'settings' => $this->settings
        ]);
    }

    public function actionLead()
    {
        $model = new LeadForm();

        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            Yii::$app->session->setFlash('leadSubmitted');
            return $this->refresh();
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact()) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['/']);
    }

    private function debug() {
        return "Welcome to ".Yii::$app->params['websiteName'];
    }

    private function getContactsWidget()
    {
        return Contacts::widget([
            'email' => $this->settings->email,
            'phone' => $this->settings->phone,
        ]);
    }

    private function getSocialsWidget()
    {
        return Socials::widget([
            'socials' => Social::getActive($this->language->shortcut)
        ]);
    }

    private function getCopyrightWidget()
    {
        return Copyright::widget([
            'siteName' => $this->settings->siteName,
        ]);
    }

    private function getHeader()
    {
        $navbarClass = 'navbar navbar-expand-md fixed-top ';
        if ($this->settings->theme) {
            $navbarClass .= $this->settings->theme->navbarColor;
        } else {
            $navbarClass .= 'bg-light navbar-light';
        }
        $items = Section::getNavigationLinks($this->language->id);
        if ($this->settings->languageEnabled) {
            $languages = array_map(function ($lang) {
                return [
                    'label' => $lang->icon('4x3', 15).' '.$lang->title,
                    'url' => Url::to(['/site/switch-lang', 'lang' => $lang->shortcut]),
                    'encode' => false, // Ensures HTML in icon is not escaped
                ];
            }, Language::find()->all());
            $languageButton = ButtonDropdown::widget([
                'label' => $this->language->icon('4x3', 15).' '.$this->language->title,
                'encodeLabel' => false,
                'dropdown' => [
                    'items' => $languages,
                    'encodeLabels' => false
                ],
                'class' => 'btn btn-primary',
                'buttonOptions' => [
                    'class' => 'btn btn-light'
                ]
            ]);
            $items[] = $languageButton;
        }

        return $this->renderPartial('@app/views/layouts/_header', [
            'brandLabel' => Html::img('@web'.$this->settings->logo, [
                'width' => $this->settings->logoWidth
            ]),
            'brandUrl' => $this->settings->logoUrl,
            'navbarClass' => $navbarClass,
            'navbarAlign' => $this->settings->navAlign,
            'items' => $items,
            'footer' => $this->getContactsWidget() . $this->getSocialsWidget() . $this->getCopyrightWidget(),
        ]);
    }

    private function getFooter()
    {
        $items = Section::getFooterLinks($this->language->id);
        return $this->renderPartial('@app/views/layouts/_footer', [
            'items' => $items,
            'logo' => [
                'label' => Html::img('@web'.$this->settings->logo, [
                    'width' => $this->settings->logoWidth
                ]),
                'url' => Url::to($this->settings->logoUrl)
            ],
            'contacts' => $this->getContactsWidget(),
            'socials' => $this->getSocialsWidget(),
            'copyright' => $this->getCopyrightWidget(),
            'footerText' => $this->settings->footerText,
        ]);
    }

    private function getOgTags($tags = [])
    {
        $tags = array_merge(
            $tags,
            [
                'siteName' => $this->settings->siteName
            ]
        );
        return $this->renderPartial('@app/views/layouts/_og', $tags);
    }

    private function getPageContext(?Page $page) {
        $context = [
            'ogTags' => '',
            'title' => ucfirst($this->action->id),
            'pageTitle' => '',
            'content' => '',
            'headScript' => '',
            'bodyScript' => ''
        ];

        if ($page !== null) {
            $context['ogTags'] = $this->getOgTags($page->getOgTags());
            $context['title'] = $page->title;
            $context['pageTitle'] = $page->shortTitle;
            $context['content'] = $page->renderContent();
            $context['contentBottom'] = $page->renderContent($page->contentBottom);
            $context['headScript'] = $page->headScript;
            $context['bodyScript'] = $page->bodyScript;
        }

        return $context;
    }

    private function getDirectoryContents($directoryPath)
    {
        $files = [];

        if (is_dir($directoryPath)) {
            if ($dh = opendir($directoryPath)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $files[] = $file;
                    }
                }
                closedir($dh);
            }
        }

        return $files;
    }
}
