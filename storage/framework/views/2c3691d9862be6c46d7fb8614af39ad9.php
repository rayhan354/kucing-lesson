<?php
    use Filament\Actions\Action;
    use Filament\Support\Enums\Alignment;
    use Illuminate\View\ComponentAttributeBag;

    $fieldWrapperView = $getFieldWrapperView();

    $items = $getItems();

    $addAction = $getAction($getAddActionName());
    $addActionAlignment = $getAddActionAlignment();
    $addBetweenAction = $getAction($getAddBetweenActionName());
    $cloneAction = $getAction($getCloneActionName());
    $deleteAction = $getAction($getDeleteActionName());
    $moveDownAction = $getAction($getMoveDownActionName());
    $moveUpAction = $getAction($getMoveUpActionName());
    $reorderAction = $getAction($getReorderActionName());
    $extraItemActions = $getExtraItemActions();

    $isAddable = $isAddable();
    $isCloneable = $isCloneable();
    $isDeletable = $isDeletable();
    $isReorderableWithButtons = $isReorderableWithButtons();
    $isReorderableWithDragAndDrop = $isReorderableWithDragAndDrop();

    $key = $getKey();
    $statePath = $getStatePath();

    $tableColumns = $getTableColumns();
?>

<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $fieldWrapperView] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field]); ?>
    <div
        <?php echo e($attributes
                ->merge($getExtraAttributes(), escape: false)
                ->class(['fi-fo-table-repeater'])); ?>

    >
        <?php if(count($items)): ?>
            <table class="fi-absolute-positioning-context">
                <thead>
                    <tr>
                        <?php if((count($items) > 1) && ($isReorderableWithButtons || $isReorderableWithDragAndDrop)): ?>
                            <th
                                class="fi-fo-table-repeater-empty-header-cell"
                            ></th>
                        <?php endif; ?>

                        <?php $__currentLoopData = $tableColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                    'fi-wrapped' => $column->canHeaderWrap(),
                                    (($columnAlignment = $column->getAlignment()) instanceof Alignment) ? ('fi-align-' . $columnAlignment->value) : $columnAlignment,
                                ]); ?>"
                                style="<?php echo \Illuminate\Support\Arr::toCssStyles([
                                    ('width: ' . ($columnWidth = $column->getWidth())) => filled($columnWidth),
                                ]) ?>"
                            >
                                <?php if(! $column->isHeaderLabelHidden()): ?>
                                    <?php echo e($column->getLabel()); ?><?php if($column->isMarkedAsRequired()): ?><sup class="fi-fo-table-repeater-header-required-mark">*</sup>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="fi-sr-only">
                                        <?php echo e($column->getLabel()); ?>

                                    </span>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(count($extraItemActions) || $isCloneable || $isDeletable): ?>
                            <th
                                class="fi-fo-table-repeater-empty-header-cell"
                            ></th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <?php if(count($items)): ?>
                    <tbody
                        x-sortable
                        <?php echo e((new ComponentAttributeBag)
                                ->merge([
                                    'data-sortable-animation-duration' => $getReorderAnimationDuration(),
                                    'wire:end.stop' => 'mountAction(\'reorder\', { items: $event.target.sortable.toArray() }, { schemaComponent: \'' . $key . '\' })',
                                ], escape: false)); ?>

                    >
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemKey => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $visibleExtraItemActions = array_filter(
                                    $extraItemActions,
                                    fn (Action $action): bool => $action(['item' => $itemKey])->isVisible(),
                                );
                                $cloneAction = $cloneAction(['item' => $itemKey]);
                                $cloneActionIsVisible = $isCloneable && $cloneAction->isVisible();
                                $deleteAction = $deleteAction(['item' => $itemKey]);
                                $deleteActionIsVisible = $isDeletable && $deleteAction->isVisible();
                                $moveDownAction = $moveDownAction(['item' => $itemKey])->disabled($loop->last);
                                $moveDownActionIsVisible = $isReorderableWithButtons && $moveDownAction->isVisible();
                                $moveUpAction = $moveUpAction(['item' => $itemKey])->disabled($loop->first);
                                $moveUpActionIsVisible = $isReorderableWithButtons && $moveUpAction->isVisible();
                                $reorderActionIsVisible = $isReorderableWithDragAndDrop && $reorderAction->isVisible();
                            ?>

                            <tr
                                wire:key="<?php echo e($item->getLivewireKey()); ?>.item"
                                x-sortable-item="<?php echo e($itemKey); ?>"
                            >
                                <?php if((count($items) > 1) && ($isReorderableWithButtons || $isReorderableWithDragAndDrop)): ?>
                                    <td>
                                        <?php if($reorderActionIsVisible || $moveUpActionIsVisible || $moveDownActionIsVisible): ?>
                                            <div
                                                class="fi-fo-table-repeater-actions"
                                            >
                                                <?php if($reorderActionIsVisible): ?>
                                                    <div
                                                        x-sortable-handle
                                                        x-on:click.stop
                                                    >
                                                        <?php echo e($reorderAction); ?>

                                                    </div>
                                                <?php endif; ?>

                                                <?php if($moveUpActionIsVisible || $moveDownActionIsVisible): ?>
                                                    <div x-on:click.stop>
                                                        <?php echo e($moveUpAction); ?>

                                                    </div>

                                                    <div x-on:click.stop>
                                                        <?php echo e($moveDownAction); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>

                                <?php
                                    $counter = 0
                                ?>

                                <?php $__currentLoopData = $item->getComponents(withHidden: true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        throw_unless(
                                            $component instanceof \Filament\Forms\Components\Field || $component instanceof \Filament\Infolists\Components\Entry,
                                            new \Exception('Table repeaters must only contain form fields and infolist entries, but [' . $component::class . '] was used.'),
                                        );
                                    ?>

                                    <?php if(count($tableColumns) > $counter): ?>
                                        <?php if($component instanceof \Filament\Forms\Components\Hidden): ?>
                                            <?php echo e($component); ?>

                                        <?php else: ?>
                                            <?php
                                                $counter++
                                            ?>

                                            <?php if($component->isVisible()): ?>
                                                <td>
                                                    <?php echo e($component); ?>

                                                </td>
                                            <?php else: ?>
                                                <td class="fi-hidden"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(count($extraItemActions) || $isCloneable || $isDeletable): ?>
                                    <td>
                                        <?php if($visibleExtraItemActions || $cloneActionIsVisible || $deleteActionIsVisible): ?>
                                            <div
                                                class="fi-fo-table-repeater-actions"
                                            >
                                                <?php $__currentLoopData = $visibleExtraItemActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraItemAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div x-on:click.stop>
                                                        <?php echo e($extraItemAction(['item' => $itemKey])); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php if($cloneActionIsVisible): ?>
                                                    <div x-on:click.stop>
                                                        <?php echo e($cloneAction); ?>

                                                    </div>
                                                <?php endif; ?>

                                                <?php if($deleteActionIsVisible): ?>
                                                    <div x-on:click.stop>
                                                        <?php echo e($deleteAction); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                <?php endif; ?>
            </table>
        <?php endif; ?>

        <?php if($isAddable && $addAction->isVisible()): ?>
            <div
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-fo-table-repeater-add',
                    ($addActionAlignment instanceof Alignment) ? ('fi-align-' . $addActionAlignment->value) : $addActionAlignment,
                ]); ?>"
            >
                <?php echo e($addAction); ?>

            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\vendor\filament\forms\resources\views\components\repeater\table.blade.php ENDPATH**/ ?>