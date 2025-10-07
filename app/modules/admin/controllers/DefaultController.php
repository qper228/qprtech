<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\CssForm;
use app\modules\admin\models\InvoiceForm;
use app\modules\admin\models\RobotsForm;
use app\modules\admin\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'roles' => ['admin']],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'removeFile' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCss()
    {
        $model = new CssForm();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->write()) {
                        Yii::$app->session->setFlash('success', '✅ File was successfully updated!');
                        return $this->refresh();
                    } else {
                        // Write() failed — show its collected errors
                        $errorText = implode("\n", $model->getErrorSummary(true));
                        Yii::$app->session->setFlash('error', "❌ Failed to write file:\n" . $errorText);
                    }
                } else {
                    // Validation failed
                    $errorText = implode("\n", $model->getErrorSummary(true));
                    Yii::$app->session->setFlash('error', "⚠️ Validation failed:\n" . $errorText);
                }
            }
        }

        return $this->render('file', [
            'model' => $model,
        ]);
    }


    public function actionRobots() {
        $model = new RobotsForm();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->write()) {
                Yii::$app->getSession()->setFlash('update', 'File was successfully updated!');
                return $this->refresh();
            }
        }
        return $this->render('file', [
            'model' => $model
        ]);
    }

    public function actionUploads() {
        $uploadDir = Yii::$app->basePath.'/web/uploads';
        $files = array_slice(scandir($uploadDir), 2);
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstances($model, 'files');

            if ($model->files && $model->validate()) {
                foreach ($model->files as $file) {
                    $file->saveAs($uploadDir.'/' . $file->baseName . '.' . $file->extension);
                }
                $model->files = null;
                Yii::$app->getSession()->setFlash('update', 'Files was successfully uploaded!');
                return $this->refresh();
            }
        }
        return $this->render('uploads', [
            'files' => $files,
            'model' => $model
        ]);
    }

    public function actionRemoveFile($file) {
        $uploadDir = Yii::$app->basePath.'/web/uploads';
        unlink($uploadDir.'/'.$file);
        Yii::$app->getSession()->setFlash('update', 'Files was successfully removed!');
        return $this->redirect(['/admin/default/uploads']);
    }

    public function actionInvoice() {
        $model = new InvoiceForm();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                return $this->render('invoice_url', [
                    'url' => $model->getInvoiceUrl()
                ]);
            }
        }
        return $this->render('invoice', [
            'model' => $model
        ]);
    }
}
