<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'login',
        'role',
        'active',

        ['class' => 'yii\grid\ActionColumn',
            'header' => '',
            'template' => '{change-active} {change-role}',
            'buttons' => [
                'change-active' => function ($url) {
                    return Html::a('Change Active', $url, ['class' => 'btn btn-success']);
                },
                'change-role' => function ($url) {
                    return Html::a('Change role', $url, ['class' => 'btn btn-success']);
                },

            ],
        ],
    ],

]); ?>
