<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
<<<<<<< HEAD
=======
use frontend\assets\AppAsset;

AppAsset::register($this);

>>>>>>> feature/Eduardo-Estrella

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
        <?= $this->render('partials/menu') ?>


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

    <?php //= $this->render('partials/customizer') 
    ?>
    <?= $this->render('partials/vendor-scripts') ?>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>