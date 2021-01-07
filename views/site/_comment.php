<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div class="post">
    <table>
        <tr class="comment-title">
            <th>
                <?= $model->user->login ?>
                <?= $model->created ?>
            </th>
        </tr>
        <tr class="comment-body">
            <th >
                <p>
                <?= $model->comment ?>
                </p>
            </th>
        </tr>
    </table>
</div>