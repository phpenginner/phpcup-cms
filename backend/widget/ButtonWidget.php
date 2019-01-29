<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/28
 * Time: 14:44
 */
namespace backend\widget;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
class ButtonWidget extends \yii\base\Widget
{
    /*定义默认的父级样式*/
    public $options = [
        'class' => 'mail-tools tooltip-demo m-t-md',
    ];
    public $buttons = [];

    public $template = [];

    /*
     * 小部件的入口方法
     */
    public function run()
    {
        $buttons = '';
        $this->initDefaultButtons();
        $buttons .= $this->renderDataCellContent();
        return "<div class='{$this->options['class']}'>{$buttons}</div>";
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent()
    {
        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) {
            $name = $matches[1];
            if (isset($this->buttons[$name])) {
                return $this->buttons[$name] instanceof \Closure ? call_user_func($this->buttons[$name]) : $this->buttons[$name];
            } else {
                return '';
            }


        }, $this->template);
    }

    /**
     * 默认按钮
     */
    protected function initDefaultButtons()
    {
        if (! isset($this->buttons['refresh'])) {
            $this->buttons['refresh'] = function () {
                return Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app', 'Refresh'), Url::to(['refresh']), [
                    'title' => Yii::t('app', 'Refresh'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-info btn-rounded',
                ]);
            };
        }

        if (! isset($this->buttons['create'])) {
            $this->buttons['create'] = function () {
                return Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), Url::to(['create']), [
                    'title' => Yii::t('app', 'Create'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-primary btn-rounded',
                ]);
            };
        }

        if (! isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function () {
                return Html::a('<i class="fa fa-trash-o"></i> ' . Yii::t('app', 'Delete'), Url::to(['delete']), [
                    'title' => Yii::t('app', 'Delete'),
                    'data-pjax' => '0',
                    'data-confirm' => Yii::t('app', 'Really to delete?'),
                    'class' => 'btn btn-danger btn-rounded',
                ]);
            };
        }
    }

}