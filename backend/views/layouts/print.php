<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
    }

    .btn-print {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        width: 100px;
        text-align: center;
        cursor: pointer;
    }

    @media print {
        .btn-print {
            display: none;
        }
    }

    /* Ocultar botón al imprimir */
    </style>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="container">
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>