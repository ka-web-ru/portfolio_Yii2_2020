<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteMenu */

$this->title = 'Update Site Menu: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Site Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
