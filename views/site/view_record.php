<?php


use yii\widgets\ListView;
use yii\widgets\DetailView;

echo DetailView::widget([
    'model' => $record,
    'attributes' => [
        'title',
        'text',
        [
            'attributy' => 'record',
            'value' => function ($record) {
                return $record->user->login;
            },
            'label' => 'Avtor'
        ],

    ],
]);

if (!Yii::$app->user->isGuest) {
    echo $this->render('_commentForm', [
        'model' => $commentForm,
    ]);
}

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_comment',
]);
?>