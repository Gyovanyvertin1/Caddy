<?php $__env->startSection('main'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('new-order-wizard', [])->html();
} elseif ($_instance->childHasBeenRendered('ZVvbrJu')) {
    $componentId = $_instance->getRenderedChildComponentId('ZVvbrJu');
    $componentTag = $_instance->getRenderedChildComponentTagName('ZVvbrJu');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ZVvbrJu');
} else {
    $response = \Livewire\Livewire::mount('new-order-wizard', []);
    $html = $response->html();
    $_instance->logRenderedChild('ZVvbrJu', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</livewire:new-order-wizard>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\caddy-master\resources\views/order-wizard.blade.php ENDPATH**/ ?>