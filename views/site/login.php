<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['bodyClass'] = 'gray-bg';
?>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{input}",
                ],
            ]); ?>
            <div class="row keyboard-inp">
                <?= $form->field($model, 'password')->hiddenInput(); ?>
                <div class="col-md-3"><div class="keybaord-inp-item"><i class="fa fa-circle-o" aria-hidden="true"></i></div></div>
                <div class="col-md-3"><div class="keybaord-inp-item"><i class="fa fa-circle-o" aria-hidden="true"></i></div></div>
                <div class="col-md-3"><div class="keybaord-inp-item"><i class="fa fa-circle-o" aria-hidden="true"></i></div></div>
                <div class="col-md-3"><div class="keybaord-inp-item"><i class="fa fa-circle-o" aria-hidden="true"></i></div></div>
            </div>
            <div class="row keyboard-btn">
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="1">1</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="2">2</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="3">3</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="4">4</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="5">5</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="6">6</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="7">7</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="8">8</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="9">9</button></div>
                <div class="col-md-4"><button type="button" class="keybaord-btn-item btn btn-info  dim btn-large-dim btn-outline" data-val="0">0</button></div>
                <div class="col-md-4"><button disabled="disabled" type="button" class="keybaord-btn-item btn btn-danger  dim btn-large-dim" data-val="del"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></button></div>
                <div class="col-md-4"><?= Html::submitButton('<i class="fa fa-sign-in" aria-hidden="true"></i>', ['disabled' => 'disabled', 'class' => 'keybaord-btn-item btn btn-primary  dim btn-large-dim', 'data-val' => 'login', 'name' => 'login-button']) ?></div>
            </div>
                <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php /*<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
*/ ?>