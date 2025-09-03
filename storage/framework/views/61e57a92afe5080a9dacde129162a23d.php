<ul
    <?php echo e($getExtraAttributeBag()->class([
            'fi-sc-unordered-list',
            (($size = $getSize()) instanceof \Filament\Support\Enums\TextSize) ? "fi-size-{$size->value}" : $size,
        ])); ?>

>
    <?php $__currentLoopData = $getChildSchema()->getComponents(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <?php echo e($component); ?>

        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\vendor\filament\schemas\resources\views\components\unordered-list.blade.php ENDPATH**/ ?>