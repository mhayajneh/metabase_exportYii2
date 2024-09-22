<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MetabaseDatabase;

/* @var $this yii\web\View */
/* @var $model app\models\MetabaseDatabase */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Clone Metabase Database';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="metabase-database-clone">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="metabase-database-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'existing_database_id')
            ->dropDownList(
                ArrayHelper::map(MetabaseDatabase::find()->all(), 'id', 'name'),
                ['prompt' => 'Select Metabase Database']
            )->label('Select Existing Database') ?>

        <?= $form->field($model, 'new_database_name')->textInput(['maxlength' => true])->label('New Database Name') ?>

        <div class="form-group">
            <?= Html::submitButton('Clone Database', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>