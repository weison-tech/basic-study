<?php
namespace core\modules\file\controllers;

use Yii;
use yii\web\HttpException;
use yii\helpers\FileHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use core\components\Controller;
use core\modules\file\models\File;

/**
 * Class FileController
 * @package core\modules\file\controllers
 * @author xiaomalover <xiaomalover@gmail.com>
 */
class FileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'admin',
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['download'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'core\modules\file\actions\UploadAction',
            ],
            'upload-simple' => [
                'class' => 'core\modules\file\actions\UploadSimpleAction',
            ],
        ];
    }


    /**
     * Downloads a file
     */
    public function actionDownload()
    {
        // GUID of file
        $guid = Yii::$app->request->get('guid');

        // Force Download Flag
        $download = Yii::$app->request->get('download', 0);

        // Optional suffix of file (e.g. scaled variant of image)
        $suffix = Yii::$app->request->get('suffix');

        $file = File::findOne(['guid' => $guid]);
        if ($file == null) {
            throw new HttpException(
                404,
                Yii::t(
                    'FileModule.controllers_FileController',
                    'Could not find requested file!'
                )
            );
        }

        if (!file_exists($file->getStoredFilePath($suffix))) {
            throw new HttpException(
                404,
                Yii::t(
                    'FileModule.controllers_FileController',
                    'Could not find requested file!'
                )
            );
        }

        $options = [
            'inline' => false,
            'mimeType' => FileHelper::getMimeTypeByExtension($file->getFilename($suffix))
        ];

        if ($download != 1 && in_array($options['mimeType'], Yii::$app->getModule('file')->inlineMimeTypes)) {
            $options['inline'] = true;
        }

        if (!Yii::$app->getModule('file')->settings->get('useXSendfile')) {
            Yii::$app->response->sendFile($file->getStoredFilePath($suffix), $file->getFilename($suffix), $options);
        } else {
            $filePath = $file->getStoredFilePath($suffix);

            if (strpos($_SERVER['SERVER_SOFTWARE'], 'nginx') === 0) {
                // set nginx specific X-Sendfile header name
                $options['xHeader'] = 'X-Accel-Redirect';
                // make path relative to docroot
                $docroot = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR);
                if (substr($filePath, 0, strlen($docroot)) == $docroot) {
                    $filePath = substr($filePath, strlen($docroot));
                }
            }

            Yii::$app->response->xSendFile($filePath, $file->getFilename($suffix), $options);
        }
    }

    /**
     * Delete file.
     * @throws HttpException
     */
    public function actionDelete()
    {
        $guid = Yii::$app->request->post('guid');
        $file = File::findOne(['guid' => $guid]);

        if ($file == null) {
            throw new HttpException(
                404,
                Yii::t(
                    'FileModule.controllers_FileController',
                    'Could not find requested file!'
                )
            );
        }

        $file->delete();
    }
}
