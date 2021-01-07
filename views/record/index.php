<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Records';

?>
<div class="record-index">
    <p>
        <?= Html::a('Create Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'text',
            'active',
            ['class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{view} {update} {delete}',

            ],
        ],

    ]); ?>


</div>
