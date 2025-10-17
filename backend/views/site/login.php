<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';


?>

<?php if (Yii::$app->session->hasFlash('success')) : ?>
  <div class="alert alert-success">
    <?= Yii::$app->session->getFlash('success'); ?>
  </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('warning')) : ?>
  <div class="alert alert-warning">
    <?= Yii::$app->session->getFlash('warning'); ?>
  </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')) : ?>
  <div class="alert alert-danger">
    <?= Yii::$app->session->getFlash('error'); ?>
  </div>
<?php endif; ?>

<head>

</head>

<body>

  <div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">

      <div class="bg-overlay"></div>

      <div class="shape">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
          <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
        </svg>
      </div>

    </div>

    <!-- auth page content -->
    <div class="auth-page-content">

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="text-center mt-sm-5 mb-4 text-white-50">

              <div>
                <a href="index.php" class="d-inline-block auth-logo">
                  <img src="assets/images/logo-light.png" alt="" height="20">
                </a>
              </div>

              <p class="mt-3 fs-15 fw-medium">SUITE - jDRH</p>

            </div>

          </div>

        </div>
        <!-- end row -->

        <div class="row justify-content-center">

          <div class="col-md-8 col-lg-6 col-xl-5">

            <div class="card mt-4">

              <div class="card-body p-4">

                <div class="text-center mt-2">

                  <h5 class="text-primary">Bienvenido de nuevo !</h5>
                  <p class="text-muted">Complete los siguientes campos para iniciar sesión.</p>

                </div>

                <div class="p-2 mt-4">

                  <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                  <form>


                    <?= $form->field($model, 'username')->textInput([
                      'autofocus' => true,
                      'class' => 'form-control'
                    ])->label('Usuario'); ?>

                </div>

                <div class="position-relative mb-3 px-2">

                  <?= $form->field($model, 'password', [
                    'template' => '{label}<div class="input-group">{input}<button class="btn btn-link text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-line"></i></button></div>{error}',
                    'options' => ['class' => 'form-group'],
                  ])->passwordInput([
                    'class' => 'form-control',
                    'id' => 'password-input',
                    'placeholder' => 'Enter password',
                  ]) ?>
                </div>

                <div class="d-flex justify-content-between m-2">

                  <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'form-check-input']) ?>

                  <?= Html::a('¿Olvidaste tu contraseña?', ['/site/request-password-reset']); ?>

                </div>

                <div class="mt-4 p-2">
                  <?= Html::submitButton('Iniciar Sesion', ['class' => 'btn btn-success w-100', 'name' => 'login-button']) ?>
                </div>

              </div>

              </form>

              <?php ActiveForm::end(); ?>

            </div>

          </div>
          <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="mt-4 text-center">
          <p class="mb-0">¿ No tienes una cuenta ? <?= Html::a('Registrate', ['site/signup'], ['class' => 'fw-semibold text-primary text-decoration-underline']) ?></p>
        </div>

      </div>

    </div>
    <!-- end row -->
  </div>
  <!-- end container -->


</body>