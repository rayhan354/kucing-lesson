<?php
    use Filament\Actions\Action;
    use Filament\Support\Enums\Alignment;

    $fieldWrapperView = $getFieldWrapperView();
    $items = $getItems();
    $blockPickerBlocks = $getBlockPickerBlocks();
    $blockPickerColumns = $getBlockPickerColumns();
    $blockPickerWidth = $getBlockPickerWidth();
    $hasBlockPreviews = $hasBlockPreviews();
    $hasInteractiveBlockPreviews = $hasInteractiveBlockPreviews();

    $addAction = $getAction($getAddActionName());
    $addActionAlignment = $getAddActionAlignment();
    $addBetweenAction = $getAction($getAddBetweenActionName());
    $cloneAction = $getAction($getCloneActionName());
    $collapseAllAction = $getAction($getCollapseAllActionName());
    $editAction = $getAction($getEditActionName());
    $expandAllAction = $getAction($getExpandAllActionName());
    $deleteAction = $getAction($getDeleteActionName());
    $moveDownAction = $getAction($getMoveDownActionName());
    $moveUpAction = $getAction($getMoveUpActionName());
    $reorderAction = $getAction($getReorderActionName());
    $extraItemActions = $getExtraItemActions();

    $isAddable = $isAddable();
    $isCloneable = $isCloneable();
    $isCollapsible = $isCollapsible();
    $isDeletable = $isDeletable();
    $isReorderableWithButtons = $isReorderableWithButtons();
    $isReorderableWithDragAndDrop = $isReorderableWithDragAndDrop();

    $collapseAllActionIsVisible = $isCollapsible && $collapseAllAction->isVisible();
    $expandAllActionIsVisible = $isCollapsible && $expandAllAction->isVisible();

    $key = $getKey();
    $statePath = $getStatePath();

    $blockLabelHeadingTag = $getHeadingTag();
    $isBlockLabelTruncated = $isBlockLabelTruncated();
    $labelBetweenItems = $getLabelBetweenItems();
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
                ->class([
                    'fi-fo-builder',
                    'fi-collapsible' => $isCollapsible,
                ])); ?>

    >
        <?php if($collapseAllActionIsVisible || $expandAllActionIsVisible): ?>
            <div
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-fo-builder-actions',
                    'fi-hidden' => count($items) < 2,
                ]); ?>"
            >
                <?php if($collapseAllActionIsVisible): ?>
                    <span
                        x-on:click="$dispatch('builder-collapse', '<?php echo e($statePath); ?>')"
                    >
                        <?php echo e($collapseAllAction); ?>

                    </span>
                <?php endif; ?>

                <?php if($expandAllActionIsVisible): ?>
                    <span
                        x-on:click="$dispatch('builder-expand', '<?php echo e($statePath); ?>')"
                    >
                        <?php echo e($expandAllAction); ?>

                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if(count($items)): ?>
            <ul
                x-sortable
                data-sortable-animation-duration="<?php echo e($getReorderAnimationDuration()); ?>"
                wire:end.stop="mountAction('reorder', { items: $event.target.sortable.toArray() }, { schemaComponent: '<?php echo e($key); ?>' })"
                class="fi-fo-builder-items"
            >
                <?php
                    $hasBlockLabels = $hasBlockLabels();
                    $hasBlockIcons = $hasBlockIcons();
                    $hasBlockNumbers = $hasBlockNumbers();
                ?>

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
                        $editAction = $editAction(['item' => $itemKey]);
                        $editActionIsVisible = $hasBlockPreviews && $editAction->isVisible();
                        $moveDownAction = $moveDownAction(['item' => $itemKey])->disabled($loop->last);
                        $moveDownActionIsVisible = $isReorderableWithButtons && $moveDownAction->isVisible();
                        $moveUpAction = $moveUpAction(['item' => $itemKey])->disabled($loop->first);
                        $moveUpActionIsVisible = $isReorderableWithButtons && $moveUpAction->isVisible();
                        $reorderActionIsVisible = $isReorderableWithDragAndDrop && $reorderAction->isVisible();
                    ?>

                    <li
                        wire:ignore.self
                        wire:key="<?php echo e($item->getLivewireKey()); ?>.item"
                        x-data="{
                            isCollapsed: <?php echo \Illuminate\Support\Js::from($isCollapsed($item))->toHtml() ?>,
                        }"
                        x-on:builder-expand.window="$event.detail === '<?php echo e($statePath); ?>' && (isCollapsed = false)"
                        x-on:builder-collapse.window="$event.detail === '<?php echo e($statePath); ?>' && (isCollapsed = true)"
                        x-on:expand="isCollapsed = false"
                        x-sortable-item="<?php echo e($itemKey); ?>"
                        <?php echo e($item->getParentComponent()->getExtraAttributeBag()
                                ->class(['fi-fo-builder-item'])); ?>

                        x-bind:class="{ 'fi-collapsed': isCollapsed }"
                    >
                        <?php if($reorderActionIsVisible || $moveUpActionIsVisible || $moveDownActionIsVisible || $hasBlockIcons || $hasBlockLabels || $editActionIsVisible || $cloneActionIsVisible || $deleteActionIsVisible || $isCollapsible || $visibleExtraItemActions): ?>
                            <div
                                <?php if($isCollapsible): ?>
                                    x-on:click.stop="isCollapsed = !isCollapsed"
                                <?php endif; ?>
                                class="fi-fo-builder-item-header"
                            >
                                <?php if($reorderActionIsVisible || $moveUpActionIsVisible || $moveDownActionIsVisible): ?>
                                    <ul
                                        class="fi-fo-builder-item-header-start-actions"
                                    >
                                        <?php if($reorderActionIsVisible): ?>
                                            <li
                                                x-sortable-handle
                                                x-on:click.stop
                                            >
                                                <?php echo e($reorderAction); ?>

                                            </li>
                                        <?php endif; ?>

                                        <?php if($moveUpActionIsVisible || $moveDownActionIsVisible): ?>
                                            <li x-on:click.stop>
                                                <?php echo e($moveUpAction); ?>

                                            </li>

                                            <li x-on:click.stop>
                                                <?php echo e($moveDownAction); ?>

                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>

                                <?php
                                    $blockIcon = $item->getParentComponent()->getIcon($item->getRawState(), $itemKey);
                                ?>

                                <?php if($hasBlockIcons && filled($blockIcon)): ?>
                                    <?php echo e(\Filament\Support\generate_icon_html($blockIcon, (new \Illuminate\View\ComponentAttributeBag)->class(['fi-fo-builder-item-header-icon']))); ?>

                                <?php endif; ?>

                                <?php if($hasBlockLabels): ?>
                                    <<?php echo e($blockLabelHeadingTag); ?>

                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'fi-fo-builder-item-header-label',
                                            'fi-truncated' => $isBlockLabelTruncated,
                                        ]); ?>"
                                    >
                                        <?php echo e($item->getParentComponent()->getLabel($item->getRawState(), $itemKey)); ?>


                                        <?php if($hasBlockNumbers): ?>
                                            <?php echo e($loop->iteration); ?>

                                        <?php endif; ?>
                                    </<?php echo e($blockLabelHeadingTag); ?>>
                                <?php endif; ?>

                                <?php if($editActionIsVisible || $cloneActionIsVisible || $deleteActionIsVisible || $isCollapsible || $visibleExtraItemActions): ?>
                                    <ul
                                        class="fi-fo-builder-item-header-end-actions"
                                    >
                                        <?php $__currentLoopData = $visibleExtraItemActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraItemAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li x-on:click.stop>
                                                <?php echo e($extraItemAction(['item' => $itemKey])); ?>

                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($editActionIsVisible): ?>
                                            <li x-on:click.stop>
                                                <?php echo e($editAction); ?>

                                            </li>
                                        <?php endif; ?>

                                        <?php if($cloneActionIsVisible): ?>
                                            <li x-on:click.stop>
                                                <?php echo e($cloneAction); ?>

                                            </li>
                                        <?php endif; ?>

                                        <?php if($deleteActionIsVisible): ?>
                                            <li x-on:click.stop>
                                                <?php echo e($deleteAction); ?>

                                            </li>
                                        <?php endif; ?>

                                        <?php if($isCollapsible): ?>
                                            <li
                                                class="fi-fo-builder-item-header-collapsible-actions"
                                                x-on:click.stop="isCollapsed = !isCollapsed"
                                            >
                                                <div
                                                    class="fi-fo-builder-item-header-collapse-action"
                                                >
                                                    <?php echo e($getAction('collapse')); ?>

                                                </div>

                                                <div
                                                    class="fi-fo-builder-item-header-expand-action"
                                                >
                                                    <?php echo e($getAction('expand')); ?>

                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div
                            x-show="! isCollapsed"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'fi-fo-builder-item-content',
                                'fi-fo-builder-item-content-has-preview' => $hasBlockPreviews && $item->getParentComponent()->hasPreview(),
                            ]); ?>"
                        >
                            <?php if($hasBlockPreviews && $item->getParentComponent()->hasPreview()): ?>
                                <div
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'fi-fo-builder-item-preview',
                                        'fi-interactive' => $hasInteractiveBlockPreviews,
                                    ]); ?>"
                                >
                                    <?php echo e($item->getParentComponent()->renderPreview($item->getRawState())); ?>

                                </div>

                                <?php if($editActionIsVisible && (! $hasInteractiveBlockPreviews)): ?>
                                    <div
                                        class="fi-fo-builder-item-preview-edit-overlay"
                                        role="button"
                                        x-on:click.stop="<?php echo e('$wire.mountAction(\'edit\', { item: \'' . $itemKey . '\' }, { schemaComponent: \'' . $key . '\' })'); ?>"
                                    ></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo e($item); ?>

                            <?php endif; ?>
                        </div>
                    </li>

                    <?php if(! $loop->last): ?>
                        <?php if($isAddable && $addBetweenAction(['afterItem' => $itemKey])->isVisible()): ?>
                            <li class="fi-fo-builder-add-between-items-ctn">
                                <div class="fi-fo-builder-add-between-items">
                                    <div class="fi-fo-builder-block-picker-ctn">
                                        <?php if (isset($component)) { $__componentOriginalcf011b913eed6cf65506740170d1fccb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf011b913eed6cf65506740170d1fccb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-forms::components.builder.block-picker','data' => ['action' => $addBetweenAction,'afterItem' => $itemKey,'columns' => $blockPickerColumns,'blocks' => $blockPickerBlocks,'key' => $key,'width' => $blockPickerWidth]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-forms::builder.block-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($addBetweenAction),'after-item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemKey),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blockPickerColumns),'blocks' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blockPickerBlocks),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($key),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blockPickerWidth)]); ?>
                                             <?php $__env->slot('trigger', null, []); ?> 
                                                <?php echo e($addBetweenAction(['afterItem' => $itemKey])); ?>

                                             <?php $__env->endSlot(); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf011b913eed6cf65506740170d1fccb)): ?>
<?php $attributes = $__attributesOriginalcf011b913eed6cf65506740170d1fccb; ?>
<?php unset($__attributesOriginalcf011b913eed6cf65506740170d1fccb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf011b913eed6cf65506740170d1fccb)): ?>
<?php $component = $__componentOriginalcf011b913eed6cf65506740170d1fccb; ?>
<?php unset($__componentOriginalcf011b913eed6cf65506740170d1fccb); ?>
<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php elseif(filled($labelBetweenItems)): ?>
                            <li class="fi-fo-builder-label-between-items-ctn">
                                <span class="fi-fo-builder-label-between-items">
                                    <?php echo e($labelBetweenItems); ?>

                                </span>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

        <?php if($isAddable && $addAction->isVisible()): ?>
            <?php if (isset($component)) { $__componentOriginalcf011b913eed6cf65506740170d1fccb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf011b913eed6cf65506740170d1fccb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-forms::components.builder.block-picker','data' => ['action' => $addAction,'blocks' => $blockPickerBlocks,'columns' => $blockPickerColumns,'key' => $key,'width' => $blockPickerWidth,'class' => ($addActionAlignment instanceof Alignment) ? ('fi-align-' . $addActionAlignment->value) : $addActionAlignment]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-forms::builder.block-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($addAction),'blocks' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blockPickerBlocks),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blockPickerColumns),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($key),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blockPickerWidth),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($addActionAlignment instanceof Alignment) ? ('fi-align-' . $addActionAlignment->value) : $addActionAlignment)]); ?>
                 <?php $__env->slot('trigger', null, []); ?> 
                    <?php echo e($addAction); ?>

                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf011b913eed6cf65506740170d1fccb)): ?>
<?php $attributes = $__attributesOriginalcf011b913eed6cf65506740170d1fccb; ?>
<?php unset($__attributesOriginalcf011b913eed6cf65506740170d1fccb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf011b913eed6cf65506740170d1fccb)): ?>
<?php $component = $__componentOriginalcf011b913eed6cf65506740170d1fccb; ?>
<?php unset($__componentOriginalcf011b913eed6cf65506740170d1fccb); ?>
<?php endif; ?>
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
<?php /**PATH C:\Users\ISGS\Documents\Belajar Laravel\Web Devel\kucing-lesson\vendor\filament\forms\resources\views\components\builder.blade.php ENDPATH**/ ?>