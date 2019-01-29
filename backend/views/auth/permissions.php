<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/28
 * Time: 14:23
 */
use yii\helpers\Html;
use yii\grid\GridView;
use backend\widget\ButtonWidget;
use yii\helpers\Url;
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ArrayDataProvider
 * @var $searchModel backend\models\AuthSearch
 */
$this->title = Yii::t('admin', 'Permissions');
$this->params['breadcrumbs'][] = Yii::t('admin', 'Permissions');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/baseWidget/ibox_title') ?>
            <div class="ibox-content">
                <?=  ButtonWidget::widget([
                    'buttons' => [
                        'create' => function () {
                            return Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), Url::to(['permission-create']), [
                                'title' => Yii::t('app', 'Create'),
                                'data-pjax' => '0',
                                'class' => 'btn btn-primary btn-rounded',
                            ]);
                        },
                        'delete' => function () {
                            return Html::a('<i class="fa fa-trash-o"></i> ' . Yii::t('app', 'Delete'), Url::to(['permission-delete']), [
                                'title' => Yii::t('app', 'Delete'),
                                'data-pjax' => '0',
                                'data-confirm' => Yii::t('app', 'Really to delete?'),
                                'class' => 'btn btn-danger btn-rounded',
                            ]);
                        }
                    ],
                    'template' => '{refresh} {create} {delete}'
                ]) ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions'=>[
                            'class'=>"table table-hover"
                    ],
                    'columns' => [
                        [
                            'class' => \yii\grid\CheckboxColumn::className(),
                            'checkboxOptions' => function ($model, $key, $index, $column) {
                                return ['value' => $model->name];
                            }
                        ],
                        [
                            'attribute' => 'group',
                        ],
                        [
                            'attribute' => 'category',
                        ],
                        [
                            'attribute' => 'route',
                        ],
                        [
                            'attribute' => 'method',
                            'filter' => [
                                'GET' => 'GET',
                                'POST' => 'POST',
                            ]
                        ],
                        [
                            'attribute' => 'description',
                        ],
                        [
                            'attribute' => 'sort',
                        ],
                        [
                            'class' => \backend\widget\Grid\ActionColumn::className(),
                            'width' => '190px',
                            'buttons' => [
                                'view-layer' => function($url, $model, $key){
                                    return Html::a('<i class="fa fa-folder"></i> ', 'javascript:void(0)', [
                                        'title' => Yii::t('yii', 'View'),
                                        'onclick' => "viewLayer('" . Url::to(['permission-view-layer', 'name' => $model->name]) . "',$(this))",
                                        'data-pjax' => '0',
                                        'class' => 'btn',
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<i class="fa fa-edit" aria-hidden="true"></i> ', Url::to([
                                        'permission-update',
                                        'name' => $model->name
                                    ]), [
                                        'title' => Yii::t('app', 'Update'),
                                        'data-pjax' => '0',
                                        'class' => 'btn J_menuItem',
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash-o"></i> ', Url::to(['permission-delete', 'name'=>$model->name]), [
                                        'title' => Yii::t('app', 'Delete'),
                                        'data-pjax' => '0',
                                        'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'class' => 'btn',
                                    ]);
                                },
                            ],
                            'template' => '{view-layer} {update} {delete}',
                        ]
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>