<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 17/11/16
 * Time: 17:56
 */

namespace app\controllers;


use Yii;
use yii\base\Module;
use yii\web\Controller;

class AccessController extends Controller
{
    public $isAdmin;

    public function __construct($id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->isAdmin = $this->isAdmin();
    }

    public function isAdmin()
    {
        if(Yii::$app->user->isGuest)
            return false;
        return (Yii::$app->user->identity->type == 1);
    }

}