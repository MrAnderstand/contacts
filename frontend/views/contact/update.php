<?php

use yii\helpers\Html;
use yii\grid\GridView;
// use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = 'Изменить контакт: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="contact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'phone_number',
                'format' => 'html',
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'long'],
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'
                , 'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<i class="glyphicon glyphicon-trash"></i>',
                            $url,
                            [
                                'class' => 'modal-button ajax-delete',
                                'title' => 'Удаление',
                                'data' => [
                                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                    'pjax' => 1,
                                ]
                            ]
                        );
                    },
                ]
                , 'contentOptions' => ['width' => '20px']
            ],
        ],
    ]); ?>
</div>
