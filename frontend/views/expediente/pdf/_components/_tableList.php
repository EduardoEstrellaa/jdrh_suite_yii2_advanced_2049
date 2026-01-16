<?php

use frontend\services\pdf\PdfValueFormatter as F;

/**
 * Renders a generic table with headers and rows.
 *
 * $headers: ['#', 'Label', ...]
 * $rows: [
 *   ['cells' => [
 *       ['value' => 1, 'type' => 'text|bool|date|time|map|list|date_range', 'map' => [], 'extra' => ''],
 *   ]],
 * ]
 */

/** @var array $headers */
/** @var array $rows */

$headers = $headers ?? [];
$rows = $rows ?? [];

$renderRange = static function ($value): string {
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

$renderTableCell = static function (array $cell) use ($renderRange): string {
    $type = $cell['type'] ?? 'text';
    $value = $cell['value'] ?? null;

    return match ($type) {
        'bool' => F::bool($value),
        'date' => F::date($value),
        'time' => F::time($value),
        'map' => F::map($value, $cell['map'] ?? [], $cell['fallback'] ?? 'No registrado'),
        'list' => F::listByIds($value ?? [], $cell['map'] ?? [], $cell['emptyText'] ?? ($cell['fallback'] ?? 'No registrado')),
        'date_range' => $renderRange($value),
        default => F::fmt($value),
    };
};
?>

<?php if (!empty($rows)): ?>
    <table>
        <?php if (!empty($headers)): ?>
            <tr>
                <?php foreach ($headers as $header): ?>
                    <th><?= $header ?></th>
                <?php endforeach; ?>
            </tr>
        <?php endif; ?>

        <?php foreach ($rows as $row): ?>
            <tr>
                <?php foreach ($row['cells'] ?? [] as $cell): ?>
                    <td>
                        <?= $renderTableCell($cell) ?>
                        <?php if (!empty($cell['extra'])): ?>
                            <br><span class="muted"><?= F::fmt($cell['extra']) ?></span>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="muted"><?= F::fmt(null) ?></p>
<?php endif; ?>
