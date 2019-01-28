<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/28
 * Time: 14:12
 */

namespace backend\controllers;

use backend\models\AuthSearch;
use yii;

class AuthController extends Controller
{
    /**
     * @auth - item group=权限 category=规则 description-get=列表 sort=500 method=get
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPermissions()
    {
        /** @var AuthSearch $searchModel */
        $searchModel = Yii::createObject(['class' => AuthSearch::className(),'scenario'=>'permission']);
        $dataProvider = $searchModel->searchPermissions(Yii::$app->getRequest()->getQueryParams());
        return $this->render('permissions', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}