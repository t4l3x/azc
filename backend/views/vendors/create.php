<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vendors */

$this->title = Yii::t('app', 'Create Vendors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
