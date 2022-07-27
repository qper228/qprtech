<?php

namespace app\controllers;

use app\models\Language;
use app\models\Page;
use app\models\Post;
use app\models\Section;
use app\models\Settings;
use app\models\Social;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap4\ButtonDropdown;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


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
        $language = $session->get('language', false);
        if (!$language) $language = Language::findOne(['isDefault' => true])->shortcut;
        $currentLanguage = Language::findOne(['shortcut' => $language]);
        $this->language = $currentLanguage;
        $settings = Settings::getActive($language);
        if (!$settings) throw new InvalidConfigException('You have to create `Settings` record for this language');
        $this->settings = $settings;
        $navSections = Section::getNavigationLinks($currentLanguage->id);
        $footerSections = Section::getFooterLinks($currentLanguage->id);

        $navigation = $navSections;

        if ($settings->languageEnabled) {
            $languages = ArrayHelper::toArray(Language::find()->all(), [
                'app\models\Language' => [
                    'label' => function ($lang) {
                        return $lang->icon('4x3', 15).' '.$lang->title;
                    },
                    'url' => function ($lang) {
                        return Url::to(['/site/switch-lang', 'lang' => $lang->shortcut]);
                    }
                ]
            ]);
            $languageButton = ButtonDropdown::widget([
                'label' => $currentLanguage->icon('4x3', 15).' '.$currentLanguage->title,
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
            $navigation[] = $languageButton;
        }

        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) {
            $navigation[] = [
                'url' => Url::to(['/admin/default/index']),
                'label' => '<i class="fa-solid fa-screwdriver-wrench"></i>',
                'linkOptions' => [
                    'class' => 'btn btn-link',
                ]
            ];
        }

        Yii::$app->view->params['navigation'] = $navigation;
        Yii::$app->view->params['footerNavigation'] = $this->render('@app/views/layouts/_footer', [
            'items' => $footerSections,
            'logo' => [
                'label' => Html::img('@web'.$settings->logo, [
                    'width' => $settings->logoWidth
                ]),
                'url' => Url::to($settings->logoUrl)
            ],
            'phone' => $settings->phone,
            'email' => $settings->email
        ]);
        Yii::$app->view->params['console'] = $this->debug();
        Yii::$app->view->params['settings'] = $settings;
        Yii::$app->view->params['socials'] = Social::getActive($language);
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
        return $this->actionPage('index');
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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(
            $this->settings->email,
            $this->settings->emailSender,
            $this->settings->siteName
        )) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
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
        Yii::$app->view->params['breadcrumbs'][] = Html::a('Blog', '/blog');
        Yii::$app->view->params['breadcrumbs'][] = $post->title;
        return $this->render('post', [
            'model' => $post,
            'settings' => $this->settings
        ]);
    }

    private function debug() {
        // TODO: return value you want to debug
        return str_replace('/', '', 'contact-form@'.Url::base(''));
    }
}
