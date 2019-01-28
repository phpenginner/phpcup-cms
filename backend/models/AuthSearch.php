<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/28
 * Time: 14:16
 */

namespace backend\models;
use yii;
use yii\data\ArrayDataProvider;
class AuthSearch extends Auth
{
    public function searchPermissions($params)
    {
        $array = $this->getPermissionsByGroup();
        $this->load($params);
        $temp = explode('\\', self::className());
        $temp = end($temp);
        if (isset($params[$temp])) {
            $searchArr = $params[$temp];
            foreach ($searchArr as $k => $v) {
                if ($v !== '') {
                    foreach ($array as $key => $val) {
                        if (in_array($k, ['sort'])) {
                            if ($val[$k] != $v) {
                                unset($array[$key]);
                            }
                        } else {
                            if (strpos($val[$k], $v) === false) {
                                unset($array[$key]);
                            }
                        }
                    }
                }
            }
        }
        $dataProvider = Yii::createObject([
            'class' => ArrayDataProvider::className(),
            'allModels' => $array,
            'pagination' => [
                'pageSize' => -1,
            ],
        ]);
        return $dataProvider;
    }

    public function getPermissionsByGroup($type='index')
    {
        $authManager = Yii::$app->getAuthManager();
        $fillDatas = [];
        $originPermissions = $authManager->getPermissions();

        $permissions = [];
        foreach ($originPermissions as $originPermission){
            $data = json_decode($originPermission->data, true);
            $temp = explode(":", $originPermission->name);
            $permissions[] = [
                'name' => $originPermission->name,
                'route' => $temp[0],
                'method' => $temp[1],
                'description' => $originPermission->description,
                'group' => $data['group'],
                'category' => $data['category'],
                'sort' => $data['sort'],
            ];
        }
        yii\helpers\ArrayHelper::multisort($permissions, 'sort');
        foreach ($permissions as $permission){
            $fillDatas[$permission['group']][$permission['category']][] = $permission;
        }
        $return = [];
        if( $type == 'index' ){
            foreach ($fillDatas as $value){
                foreach ($value as $val) {
                    foreach ($val as $v) {
                        $return[] = new self(array_merge($v, ['scenario' => 'role']));
                    }
                }
            }
        }else{
            $return = $fillDatas;
        }
        return $return;
    }
}