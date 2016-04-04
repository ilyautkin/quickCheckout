<?php

/**
 * The home manager controller for quickCheckout.
 *
 */
class quickCheckoutHomeManagerController extends quickCheckoutMainController {
	/* @var quickCheckout $quickCheckout */
	public $quickCheckout;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('quickcheckout');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->quickCheckout->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->quickCheckout->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->quickCheckout->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->quickCheckout->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->quickCheckout->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->quickCheckout->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->quickCheckout->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "quickcheckout-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->quickCheckout->config['templatesPath'] . 'home.tpl';
	}
}