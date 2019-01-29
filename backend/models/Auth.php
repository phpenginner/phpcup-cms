<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/28
 * Time: 14:16
 */

namespace backend\models;


use yii\base\Model;
use Yii;
class Auth extends Model
{
    public $name;

    public $type;

    public $description;

    public $ruleName;

    public $data;


    public $route;

    public $method;

    public $group;

    public $category;

    public $sort;


    public $permissions;

    public $roles;


    public function attributeLabels()
    {
        return [
            "route" => Yii::t('admin', 'Route'),
            "method" => Yii::t('admin', 'HTTP Method'),
            "description" => Yii::t('admin', 'Description'),
            "group" => Yii::t('admin', 'Group'),
            "category" => Yii::t('admin', 'Category'),
            "sort" => Yii::t('admin', 'Sort'),
            "name" => Yii::t('admin', 'Role'),
            "permissions" => Yii::t('admin', 'Permissions'),
            "roles" => Yii::t('admin', 'Role'),
        ];
    }
}