<?php

use frontend\services\pdf\PdfValueFormatter as F;

/**
 * Renders a simple key/value table.
 *
 * Expected $rows structure:
 * [
 *   ['label' => 'Nombre', 'value' => $value, 'type' => 'text|bool|date|time|map|list|date_range', 'map' => [], 'extra' => ''],
 * ]
 */

/** @var array $rows */
$rows = $rows ?? [];

$renderDateRange = static function ($value): string {
    if (!is_array($value)) {
        return F::fmt(null);
    }

    $start = $value['start'] ?? null;
    $end = $value['end'] ?? null;

    $range = trim(
        ($start ? F::dateFmt($start) : '') .
        ($end ? ' - ' . F::dateFmt($end) : '')
    );

    return F::fmt($range !== '' ? $range : null);
};

$renderValue = static function (array $row) use ($renderDateRange): string {
    $type = $row['type'] ?? 'text';
    $value = $row['value'] ?? null;

    return match ($type) {
        'bool' => F::bool($value),
        'date' => F::date($value),
        'time' => F::time($value),
        'map' => F::map($value, $row['map'] ?? [], $row['fallback'] ?? 'No registrado'),
        'list' => F::listByIds($value ?? [], $row['map'] ?? [], $row['emptyText'] ?? ($row['fallback'] ?? 'No registrado')),
        'date_range' => $renderDateRange($value),
        default => F::fmt($value),
    };
};
?>

<?php if (!empty($rows)): ?>
    <table>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td class="label"><?= $row['label'] ?? '' ?></td>
                <td class="value">
                    <?php
                    $valueHtml = $renderValue($row);
                    if (!empty($row['muted'])) {
                        $valueHtml = '<span class="muted">' . $valueHtml . '</span>';
                    }
                    echo $valueHtml;
                    ?>
                    <?php if (!empty($row['extra'])): ?>
                        <br><span class="muted"><?= F::fmt($row['extra']) ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
