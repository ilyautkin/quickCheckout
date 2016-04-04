<?php
/**
 * Templates
 */
$tpl          = $modx->getOption('tpl', $scriptProperties, 'tpl.quickCheckout.button', true);
$form         = $modx->getOption('form', $scriptProperties, 'tpl.quickCheckout.form', true);
$formOuter    = $modx->getOption('formOuter', $scriptProperties, 'tpl.quickCheckout.form.outer', true);
$hooks        = $modx->getOption('hooks', $scriptProperties, 'quickCheckout.hook,email', true);
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


/**
 * Sources
 */
$frontend_js  = str_replace('[[+assetsUrl]]', $modx->getOption('assets_url') . 'components/quickcheckout/', $frontend_js);
$frontend_css = str_replace('[[+assetsUrl]]', $modx->getOption('assets_url') . 'components/quickcheckout/', $frontend_css);
$modx->regClientCSS($frontend_css);
$modx->regClientScript($frontend_js);
$modx->regClientHTMLBlock($modx->getChunk($formOuter,
       array_merge($scriptProperties, array(
                'form' => $form,
                'emailTpl' => $emailTpl,
                'hooks' => $hooks,
                'emailTo' => $emailTo,
                'emailSubject' => $emailSubject,
                'validate' => $validate,
                'validationErrorMessage' => $validationErrorMessage,
                'successMessage' => $successMessage
           ))));

/**
 * Output
 */
$output = $modx->getChunk($tpl);
$output .= $modx->getChunk($productOuter, array('product' => $modx->getChunk($product, $scriptProperties)));
$output .= $modx->getChunk($productRowOuter, array('product' => $modx->getChunk($productRow, $scriptProperties)));

return $output;