<?php

use common\models\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<pre>
    <?php
    print_r($model->errors); //для отлова ошибок валидации
    ?>
</pre>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'tree')->dropDownList([1]) ?>

    <?= $form->field($model, 'sub')->dropDownList(ArrayHelper::map(Menu::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>