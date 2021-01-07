<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<div class="record-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= html::a($model->active ?
            'Desactive' : 'Active', [
            'change_active', 'id' => $model->id,

        ],
            ['class' => $model->active ?
                'btn btn-danger' :
                'btn btn-primary',
                'data' => [
                    'confirm' => 'Are you sure you want to change active this item?',
                    'method' => 'post',
                ],
            ],
        ) ?>

        <?= $model->active ? html::a('share',
            ['share', 'id' => $model->id],
            ['class' => 'btn btn-primary']) : null;
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'text',
            'active',
        ],
    ]) ?>

</div>
