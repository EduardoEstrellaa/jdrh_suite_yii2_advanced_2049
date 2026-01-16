<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $meta */
/** @var array $sections */
/** @var array $payload */
/** @var array $maps */

$sections = $sections ?? [];
$payload = $payload ?? [];
$maps = $maps ?? [];
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= Yii::getAlias('@frontend/web/css/pdf-expediente.css') ?>">
</head>

<body>
    <div class="pdf-wrapper">
        <?= $this->render('_components/_header', ['meta' => $meta ?? []]) ?>

        <?php foreach ($sections as $section): ?>
            <?= $this->render($section['view'], array_merge($payload, [
                'section' => $section,
                'maps' => $maps,
            ])) ?>
        <?php endforeach; ?>
    </div>
</body>

</html>
