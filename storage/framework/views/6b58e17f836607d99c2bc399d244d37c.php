<?php
$classes = Flux::classes()
    ->add('mx-auto w-full [:where(&)]:max-w-7xl px-6 lg:px-8')
    ;
?>

<div <?php echo e($attributes->class($classes)); ?> data-flux-container>
    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\vendor\livewire\flux\stubs\resources\views\flux\container.blade.php ENDPATH**/ ?>