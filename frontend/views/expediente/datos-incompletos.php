<?php

use yii\helpers\Url;

$this->title = $titulo ?? 'Información incompleta';
$urlDestino = Url::to($urlAccion ?? ['/perfil/create']);
$mensaje = $mensaje ?? 'Falta información básica para continuar.';
$boton = $boton ?? 'Completar información';
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'warning',
            title: '<?= $titulo ?>',
            text: '<?= $mensaje ?>',
            confirmButtonText: '<?= $boton ?>',
            showCloseButton: true,
            allowOutsideClick: true,
            allowEscapeKey: true
        }).then(() => {
            window.location.href = '<?= $urlDestino ?>';
        });
    });
</script>