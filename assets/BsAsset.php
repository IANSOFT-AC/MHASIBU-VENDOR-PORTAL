<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/21/2020
 * Time: 12:34 AM
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class BsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/fontawesome-free/css/all.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
       // '//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css',
        'plugins/datatables-bs4/css/dataTables.bootstrap4.css',
        'https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css',
        
       // 'css/steps.css',
       // 'css/validation.css'

    ];
    public $js = [

        //'//code.jquery.com/jquery-3.5.1.slim.min.js',
        '//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js',
        'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js ',


       
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
