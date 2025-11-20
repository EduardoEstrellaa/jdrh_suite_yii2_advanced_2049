<?php
// Mostrar siempre el topbar
echo $this->render('topbar');

// Mostrar el sidebar solo si el usuario está autenticado
if (!Yii::$app->user->isGuest) {
    echo $this->render('sidebar');
}
