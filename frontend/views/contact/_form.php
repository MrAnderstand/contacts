<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method' => 'post',
        'validateOnBlur' => false,
        'options' => [
            'data-pjax' => 1
        ]]); ?>

    <?= $form->field($model, 'name', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('name')
        ],
            'template' => "<div class='input-group'>{input}<span class='input-group-btn'>" .
            Html::submitButton('Добавить контакт', ['class' => 'btn btn-success']) . 
            "</span></div>\n{hint}\n{error}",
    ])->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>
