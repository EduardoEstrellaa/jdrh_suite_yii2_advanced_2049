<?php

use Yii;
use frontend\services\pdf\PdfValueFormatter as F;

/**
 * Header for PDF with meta info.
 *
 * @var array $meta
 */

$meta = $meta ?? [];
$generatedAt = $meta['generatedAt'] ?? date('Y-m-d');
$title = $meta['title'] ?? 'Expediente del Alumno';
$badge = $meta['badge'] ?? 'Expediente oficial';
$folio = $meta['folio'] ?? null;

/**
 * LOGO (mPDF)
 * - usa ruta física (segura): @webroot/...
 * - cambia el path a donde está tu logo
 */
$logoPath = Yii::getAlias('@webroot/img/logo-jdrh.svg');
$logoSrc = is_file($logoPath) ? $logoPath : null;

// Si prefieres base64 (por si no carga):
// $logoSrc = null;
// if (is_file($logoPath)) {
//     $ext = strtolower(pathinfo($logoPath, PATHINFO_EXTENSION));
//     $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : 'image/png';
//     $logoSrc = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($logoPath));
// }
?>

<table class="pdf-header-table" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <!-- IZQUIERDA: LOGO + TITULO -->
        <td class="pdf-header-left" valign="top">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td class="pdf-logo-cell" valign="middle">
                        <?php if ($logoSrc): ?>
                            <img src="<?= $logoSrc ?>" class="pdf-logo" width="42" />
                        <?php endif; ?>
                    </td>
                    <td class="pdf-title-cell" valign="middle">
                        <span class="pdf-title"><?= F::fmt($title) ?></span>
                        <?php if (!empty($badge)): ?>
                            <div class="small muted" style="margin-top:2px;"><?= F::fmt($badge) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($folio)): ?>
                            <div class="small muted" style="margin-top:2px;">Folio: <?= F::fmt($folio) ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </td>

        <!-- DERECHA: META -->
        <td class="pdf-header-meta" valign="top" align="right">
            <span class="pdf-header__meta-label">Fecha de emision</span><br>
            <span class="pdf-header__meta-value"><?= F::date($generatedAt) ?></span>
        </td>
    </tr>
</table>
