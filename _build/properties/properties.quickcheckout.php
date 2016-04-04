<?php

$properties = array();

/*
$tpl          = $modx->getOption('tpl', $scriptProperties, 'tpl.quickCheckout.button', true);
$form         = $modx->getOption('form', $scriptProperties, 'tpl.quickCheckout.form', true);
$formOuter    = $modx->getOption('formOuter', $scriptProperties, 'tpl.quickCheckout.form.outer', true);
$hooks        = $modx->getOption('hooks', $scriptProperties, 'email', true);
$emailTo      = $modx->getOption('emailTo', $scriptProperties, $modx->getOption('emailsender'), true);
$emailSubject = $modx->getOption('emailSubject', $scriptProperties, 'Покупка в один клик', true);
$validate     = $modx->getOption('validate', $scriptProperties, '', true);
$validationErrorMessage = $modx->getOption('validationErrorMessage', $scriptProperties, 'В форме содержатся ошибки!', true);
$successMessage = $modx->getOption('successMessage', $scriptProperties, 'Ваш заказ успешно отправлен в магазин', true);
$product      = $modx->getOption('product', $scriptProperties, 'tpl.quickCheckout.product', true);
$productOuter = $modx->getOption('productOuter', $scriptProperties, 'tpl.quickCheckout.product.outer', true);
$productRow   = $modx->getOption('productRow', $scriptProperties, 'tpl.quickCheckout.productRow', true);
$productRowOuter = $modx->getOption('productRowOuter', $scriptProperties, 'tpl.quickCheckout.productRow.outer', true);
$emailTpl     = $modx->getOption('emailTpl', $scriptProperties, 'tpl.quickCheckout.email', true);
$frontend_js  = $modx->getOption('frontend_js', $scriptProperties, '[[+assetsUrl]]default.js', true);
$frontend_css = $modx->getOption('frontend_css', $scriptProperties, '[[+assetsUrl]]default.css', true);
*/

$tmp = array(
	'tpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.button',
	),
	'form' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.form',
	),
	'formOuter' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.form.outer',
	),
    'product' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.product',
	),
	'productOuter' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.product.outer',
	),
	'productRow' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.productRow',
	),
	'productRowOuter' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.productRow.outer',
	),
	'hooks' => array(
		'type' => 'textfield',
		'value' => 'quickCheckout.hook,email',
	),
	'emailTo' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'emailSubject' => array(
		'type' => 'textfield',
		'value' => '',
	),
    'emailTpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.quickCheckout.email',
	),
	'validate' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'validationErrorMessage' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'successMessage' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'frontend_js' => array(
		'type' => 'textfield',
		'value' => '[[+assetsUrl]]default.js',
	),
	'frontend_css' => array(
		'type' => 'textfield',
		'value' => '[[+assetsUrl]]default.css',
	),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;