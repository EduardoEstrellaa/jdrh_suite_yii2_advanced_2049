<?php
/**
 * Wrapper for a PDF section card.
 *
 * @var string $title
 * @var bool $pageBlock
 * @var bool $pageBreakAfter
 * @var bool $useCard
 * @var string $extraClass Optional CSS class for custom styling per section.
 * @var callable|string $body
 */

$title = $title ?? '';
$pageBlock = $pageBlock ?? true;
$pageBreakAfter = $pageBreakAfter ?? false;
$useCard = $useCard ?? true;
$extraClass = $extraClass ?? '';
$body = $body ?? '';

$classes = ['box'];
if ($useCard) {
    $classes[] = 'section-card';
}
if ($pageBlock) {
    $classes[] = 'page-block';
}
$classes[] = $extraClass;
$classAttr = implode(' ', array_filter($classes));
?>

<div class="<?= $classAttr ?>">
    <h2><?= $title ?></h2>
    <?php
    if (is_callable($body)) {
        $body();
    } else {
        echo $body;
    }
    ?>
</div>

<?php if ($pageBreakAfter): ?>
    <div class="page-break"></div>
<?php endif; ?>
