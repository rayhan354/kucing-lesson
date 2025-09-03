

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'columns' => [
        'lg' => 2,
    ],
    'data' => [],
    'widgets' => [],
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'columns' => [
        'lg' => 2,
    ],
    'data' => [],
    'widgets' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    if (is_array($columns)) {
        $columns['lg'] ??= ($columns ? (is_array($columns) ? null : $columns) : 2);
    }
?>

<div <?php echo e($attributes->grid($columns)->class(['fi-wi'])); ?>>
    <?php
        $normalizeWidgetClass = function (string | Filament\Widgets\WidgetConfiguration $widget): string {
            if ($widget instanceof \Filament\Widgets\WidgetConfiguration) {
                return $widget->widget;
            }

            return $widget;
        };
    ?>

    <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widgetKey => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $widgetClass = $normalizeWidgetClass($widget);
        ?>

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split($widgetClass,
            [...(($widget instanceof \Filament\Widgets\WidgetConfiguration) ? [...$widget->widget::getDefaultProperties(), ...$widget->getProperties()] : $widget::getDefaultProperties()), ...$data],);

$__html = app('livewire')->mount($__name, $__params, "{$widgetClass}-{$widgetKey}", $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\vendor\filament\widgets\resources\views\components\widgets.blade.php ENDPATH**/ ?>