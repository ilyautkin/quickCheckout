<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var quickCheckout $quickCheckout */
$quickCheckout = $modx->getService('quickcheckout', 'quickCheckout', $modx->getOption('quickcheckout_core_path', null, $modx->getOption('core_path') . 'components/quickcheckout/') . 'model/quickcheckout/');
$modx->lexicon->load('quickcheckout:default');

// handle request
$corePath = $modx->getOption('quickcheckout_core_path', null, $modx->getOption('core_path') . 'components/quickcheckout/');
$path = $modx->getOption('processorsPath', $quickCheckout->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));