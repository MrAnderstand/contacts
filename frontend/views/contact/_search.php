<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'name', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => 'Введите название контакта для поиска',
        ],
        'template' => "<div class='input-group'>{input}<span class='input-group-btn'>" .
            Html::submitButton('Поиск', ['class' => 'btn btn-primary']) . 
            Html::button('Сброс', ['class' => 'btn btn-default reset-form']) . 
            "</span></div>\n{hint}\n{error}",
    ])->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>
