<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t("admin", "Login");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                    <h1>[ PHPCUP ]</h1>
                </div>
                <div class="m-b"></div>
                <h4><?= Yii::t("admin","Welcome to")?> <strong>PHPCUP <?= Yii::t("admin","CMS")?></strong></h4>
                <ul class="m-b">
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 国际化，支持中英双语</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 高安全，RBAC权限控制</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 速度快，便捷迅猛的体验</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                </ul>
                <strong>还没有账号？ <a href="#">立即注册&raquo;</a></strong>
            </div>
        </div>
        <div class="col-sm-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <a href=""><?= Yii::t("admin","Forgot password?")?></a>
            |
            <?php
            if (Yii::$app->language == 'en-US') {
                echo "<a href = " . Url::to(['site/language', 'lang' => 'zh-CN']) . " > 简体中文</a >";
            } else {
                echo "<a href=" . Url::to(['site/language', 'lang' => 'en-US']) . ">English</a>";
            }
            ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t("admin", "Login"), ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            © 2018-<?= date("Y")?> <?= Yii::t("admin","Albert")?> <?= Yii::t("admin","All Rights Reserved.")?> ICP：京ICP备17041895号-2
        </div>
    </div>
</div>
