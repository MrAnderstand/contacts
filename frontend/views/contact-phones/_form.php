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
        'validateOnBlur' => false,
        'options' => [
            'data-pjax' => 1
        ]]); ?>

    <?= $form->field($model, 'contact_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'phone_number', [
        'inputOptions' => [
            'class' => 'form-control',
        ],
        'template' => "<div class='input-group'>{input}<span class='input-group-btn'>" .
            Html::submitButton('Добавить номер', ['class' => 'btn btn-success']) . 
            "</span></div>\n{hint}\n{error}",
    ])->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999-9999',
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
