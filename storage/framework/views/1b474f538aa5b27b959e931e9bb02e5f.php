<div>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($currentStepName, $currentStepState)->html();
} elseif ($_instance->childHasBeenRendered($currentStepName)) {
    $componentId = $_instance->getRenderedChildComponentId($currentStepName);
    $componentTag = $_instance->getRenderedChildComponentTagName($currentStepName);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($currentStepName);
} else {
    $response = \Livewire\Livewire::mount($currentStepName, $currentStepState);
    $html = $response->html();
    $_instance->logRenderedChild($currentStepName, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH C:\xampp\htdocs\caddy-master\vendor\spatie\laravel-livewire-wizard\src\/../resources/views/wizard.blade.php ENDPATH**/ ?>