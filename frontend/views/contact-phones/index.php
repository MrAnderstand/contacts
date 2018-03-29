<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactPhonesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Изменить контакт: ' . $contactModel->name;
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['contact/index']];
$this->params['breadcrumbs'][] = ['label' => $contactModel->name];
$this->params['breadcrumbs'][] = 'Изменить';

$this->registerJsFile('@web/js/contact-phones.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="contact-phones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax-contact-phones', 'enablePushState' => false, 'timeout' => 5000]); ?>
    <?php echo $this->render('_form', ['model' => $createModel]); ?>

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
