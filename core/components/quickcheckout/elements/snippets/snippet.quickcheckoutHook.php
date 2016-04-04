<?php
/** @var array $scriptProperties */
/** @var quickCheckout $quickCheckout */
if (!$quickCheckout = $modx->getService('quickcheckout', 'quickCheckout', $modx->getOption('quickcheckout_core_path', null, $modx->getOption('core_path') . 'components/quickcheckout/') . 'model/quickcheckout/', array())) {
    return 'Could not load quickCheckout class!';
}

$order = $modx->newObject('quickCheckoutOrder');

$q = $modx->newQuery('quickCheckoutStatus', array('active' => 1));
$q->sortby('rank', 'ASC');
$q->prepare();
$status = $modx->getObject('quickCheckoutStatus', $q);
if ($status) {
    $order->set('status', $status->get('id'));
}

if ($hook->getValue('name')) {
    $order->set('name', $hook->getValue('name'));
}
if ($hook->getValue('phone')) {
    $order->set('phone', $hook->getValue('phone'));
}
if ($hook->getValue('address')) {
    $order->set('address', $hook->getValue('address'));
}
if ($hook->getValue('description')) {
    $description = $hook->getValue('description') . PHP_EOL . PHP_EOL;
}

foreach ($hook->getValues() as $key => $value) {
    if (!in_array($key, array('name', 'phone', 'address'))) {
        $description .= $key . ': ' . $value . PHP_EOL;
    }
}

$order->set('description', $description);
$order->save();
return true;