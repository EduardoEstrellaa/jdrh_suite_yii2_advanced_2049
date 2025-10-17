<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg" data-sidebar="dark" data-sidebar-image="none" data-preloader="disable" data-layout-position="scrollable">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= $this->render('partials/head-css') ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= $this->render('partials/menu') ?>
        <?php endif; ?>

        <!-- Start right Content here -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?= $this->render('partials/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?= $this->render('partials/customizer') ?>
    <?= $this->render('partials/vendor-scripts') ?>
    <!-- App js -->
    <script src="<?= Url::base(true) ?>/theme/libs/flatpickr/flatpickr.min.js"></script>
    <script src="<?= Url::base(true) ?>/theme/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= Url::base(true) ?>/theme/js/app.js"></script>
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluye Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

    <!-- Incluye el JavaScript de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>