<?php

$chunks = array();

$tmp = array(
    'tpl.quickCheckout.button' => array(
    	'file' => 'button',
		'description' => '',
	),
    'tpl.quickCheckout.email' => array(
        'file' => 'email',
		'description' => '',
	),
    'tpl.quickCheckout.form' => array(
        'file' => 'form',
		'description' => '',
	),
    'tpl.quickCheckout.form.outer' => array(
        'file' => 'form_outer',
		'description' => '',
	),
    'tpl.quickCheckout.product' => array(
        'file' => 'product',
		'description' => '',
	),
    'tpl.quickCheckout.product.outer' => array(
        'file' => 'product_outer',
		'description' => '',
	),
    'tpl.quickCheckout.productRow' => array(
        'file' => 'productRow',
		'description' => '',
	),
    'tpl.quickCheckout.productRow.outer' => array(
        'file' => 'productRow_outer',
		'description' => '',
	),
	/*
    'tpl.quickCheckout.item' => array(
		'file' => 'item',
		'description' => '',
	),
	'tpl.quickCheckout.office' => array(
		'file' => 'office',
		'description' => '',
	),
    */
);

// Save chunks for setup options
$BUILD_CHUNKS = array();

foreach ($tmp as $k => $v) {
	/* @avr modChunk $chunk */
	$chunk = $modx->newObject('modChunk');
	$chunk->fromArray(array(
		'id' => 0,
		'name' => $k,
		'description' => @$v['description'],
		'snippet' => file_get_contents($sources['source_core'] . '/elements/chunks/chunk.' . $v['file'] . '.tpl'),
		'static' => BUILD_CHUNK_STATIC,
		'source' => 1,
		'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/chunks/chunk.' . $v['file'] . '.tpl',
	), '', true, true);

	$chunks[] = $chunk;

	$BUILD_CHUNKS[$k] = file_get_contents($sources['source_core'] . '/elements/chunks/chunk.' . $v['file'] . '.tpl');
}

unset($tmp);
return $chunks;