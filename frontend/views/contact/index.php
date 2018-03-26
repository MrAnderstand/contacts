<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить контакт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, Url::toRoute(['contact/update', 'id' => $model->id]));
                },
                'format' => 'html',
            ],
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'
                // , 'buttons' => [
                //     'delete' => function ($url, $model) {
                //         return Html::a(
                //             '<i class="glyphicon glyphicon-trash"></i>',
                //             '#',
                //             ['class' => 'modal-button', 'url' => $url.'&ajax=1', 'title' => 'Просмотр', 'data-pjax'=>'1']
                //         );
                //     },
                // ]
                , 'contentOptions' => ['width' => '20px']
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
