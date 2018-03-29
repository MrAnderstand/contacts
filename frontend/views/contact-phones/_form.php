<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactPhones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-phones-form">

    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method' => 'post',
        'options' => [
            'data-pjax' => 1
        ]]); ?>

    <?= $form->field($model, 'contact_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'phone_number', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('phone_number')
        ],
            'template' => "<div class='input-group'>{input}<span class='input-group-btn'>" .
            Html::submitButton('Добавить номер', ['class' => 'btn btn-success']) . 
            "</span></div>",
    ])->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>
