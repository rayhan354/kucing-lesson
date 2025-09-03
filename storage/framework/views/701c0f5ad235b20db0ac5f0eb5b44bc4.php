<div <?php echo e($attributes->merge(['class' => 'fi-in-tags-entry p-4 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800'])); ?>>  <!-- Rectangle container -->
    <label class="fi-in-entry-label text-sm font-medium text-gray-700 dark:text-gray-300">
        <?php echo e($getLabel()); ?>

    </label>

    <div class="fi-in-tags-container flex flex-wrap gap-2 mt-2">
        <?php $__empty_1 = true; $__currentLoopData = $getState(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <span class="fi-in-tag px-3 py-1 text-sm font-medium rounded-full <?php echo e($tag === 'admin' ? 'bg-red-500 text-white' : ($tag === 'student' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white')); ?>">  <!-- Colored pills; customize colors per role -->
                <?php echo e($tag); ?>

            </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500 dark:text-gray-400">
                No roles assigned
            </p>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\resources\views\filament\infolists\components\tags-entry.blade.php ENDPATH**/ ?>