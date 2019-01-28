<?php
/**
 * Created by PhpStorm.
 * User: Albert-幸运。
 * Date: 2019/1/28
 * Time: 14:34
 */
use yii\widgets\Breadcrumbs;

?>
<div class="ibox-title">
    <span style="float: left;">
        <?= Breadcrumbs::widget([
            'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
    </span>
    <div class="ibox-tools">
        <a class="collapse-link ui-sortable">
            <i class="fa fa-chevron-up"></i>
        </a>
        <a class="close-link">
            <i class="fa fa-times"></i>
        </a>
    </div>
</div>
