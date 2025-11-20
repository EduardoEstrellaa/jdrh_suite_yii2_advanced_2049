<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

AppAsset::register($this);

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

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
            <?= $this->render('partials/footer') ?>
        </div>
    </div>

    <?= $this->render('partials/vendor-scripts') ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>