<?php


use yii\grid\GridView;


if (!Yii::$app->user->isGuest) {
    echo $this->render('_commentForm', [
        'model' => $commentForm,
    ]);
}


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'comment',
        [
            'attribute' => 'user_id',
            'value' => 'user.login',
            'label' => 'User Login',
        ],
        'created',
    ],


]);

?>