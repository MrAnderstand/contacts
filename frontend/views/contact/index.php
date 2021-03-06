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

$this->registerJsFile('@web/js/contact.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax-contact', 'enablePushState' => false, 'timeout' => 5000]); ?>
    <?php echo $this->render('_form', ['model' => $createModel]); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, Url::toRoute(['contact-phones/index', 'id' => $model->id]), ['data-pjax' => 0]);
                },
                'format' => 'raw',      // Html не пропустит data-pjax
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
                                'class' => 'modal-button',
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
    <?php Pjax::end(); ?>
</div>
