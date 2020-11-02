<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteMenu */

$this->title = 'Create Site Menu';
$this->params['breadcrumbs'][] = ['label' => 'Site Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
