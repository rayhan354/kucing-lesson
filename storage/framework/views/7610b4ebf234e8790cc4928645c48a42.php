<?php
    use Filament\Support\Enums\Alignment;

    $alignment = $getAlignment();
    $height = $getImageHeight() ?? '8rem';
    $width = $getImageWidth();
    $tooltip = $getTooltip();

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }
?>

<img
    alt="<?php echo e($getAlt()); ?>"
    src="<?php echo e($getUrl()); ?>"
    <?php if(filled($tooltip)): ?>
        x-tooltip="{ content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>, theme: $store.theme }"
    <?php endif; ?>
    <?php echo e($getExtraAttributeBag()
            ->class([
                'fi-sc-image',
                ($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : $alignment,
            ])
            ->style([
                "height: {$height}" => $height,
                "width: {$width}" => $width,
            ])); ?>

/>
<?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\vendor\filament\schemas\resources\views\components\image.blade.php ENDPATH**/ ?>