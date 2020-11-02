<?php

namespace backend\controllers;

use common\models\ImageManager;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\base\DynamicModel;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'save-redactor-img', 'save-img'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // сохранение картинки выбранной в редакторе
    public function actionSaveRedactorImg($sub = 'main')
    {
        $this->enableCsrfValidation = false; //отключить csrf валидацию, т.к. при ajax вызовах этот параметр не передается
        if (Yii::$app->request->isPost) {
            $dir = Yii::getAlias('@images' . '/' . $sub . '/'); //алиас прописан тут yii2\common\config\bootstrap.php, ну и папку нужно создать
            if (!file_exists($dir)) { // если папка не создана, то содать ее
                FileHelper::createDirectory($dir);
            }
            $result_link = str_replace('/admin', '', Url::home(true)) . 'upload/images/' . $sub . '/'; // admin нужно убрать из пути к картинке
            $file = UploadedFile::getInstanceByName('file'); // из виджета редактора файл приходит с именем 'file'
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', 'image')->validate();
            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            } else {
                $model->file->name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' . $model->file->extension;
                if ($model->file->saveAs($dir . $model->file->name)) {
                    $imag = Yii::$app->image->load($dir . $model->file->name);
                    $imag->resize(800, NULL, yii\image\drivers\Image::PRECISE)->save($dir . $model->file->name, 85);
                    $result = ['filelink' => $result_link . $model->file->name, 'filename' => $model->file->name];
                } else {
                    $result = ['error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD_FILE')];
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;
        } else {
            throw new BadRequestHttpException('Only POST is allowed');
        }
    }

    // сохранение нескольких картинок
    public function actionSaveImg()
    {
        $this->enableCsrfValidation = false; //отключить csrf валидацию, т.к. при ajax вызовах этот параметр не передается
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $dir = Yii::getAlias('@images' . '/' . $post['ImageManager']['class'] . '/'); //алиас прописан тут yii2\common\config\bootstrap.php, ну и папку нужно создать
            if (!file_exists($dir)) { // если папка не создана, то содать ее
                FileHelper::createDirectory($dir);
            }
            $result_link = str_replace('/admin', '', Url::home(true)) . 'upload/images/' . $post['ImageManager']['class'] . '/'; // admin нужно убрать из пути к картинке
            $model = new ImageManager();
            // $file = UploadedFile::getInstances($model, 'attachment'); // из виджета редактора файл приходит с именем 'ImageManager'
            $file = UploadedFile::getInstances($model, 'attachment'); // тут $model указывает на ImageManager, а attachment - это глобальная переменная $attachment в которой хранятся картинки в модели
            Yii::info(print_r($file, true), 'my'); // в логе искать category 'my'
            $model->name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file[0]->extension;
            $model->load($post);
            $model->validate();
            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('attachment')
                ];
            } else {
                if ($file[0]->saveAs($dir . $model->name)) {
                    $imag = Yii::$app->image->load($dir . $model->name);
                    $imag->resize(800, NULL, yii\image\drivers\Image::PRECISE)->save($dir . $model->name, 85);
                    $result = ['filelink' => $result_link . $model->name, 'filename' => $model->name];
                } else {
                    $result = ['error' => 'ошибка сохранения файла'];
                }
                $model->save();
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;
        } else {
            throw new BadRequestHttpException('Only POST is allowed');
        }
    }
}