<?php

/**
 * Class quickCheckoutMainController
 */
abstract class quickCheckoutMainController extends modExtraManagerController {
	/** @var quickCheckout $quickCheckout */
	public $quickCheckout;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('quickcheckout_core_path', null, $this->modx->getOption('core_path') . 'components/quickcheckout/');
		require_once $corePath . 'model/quickcheckout/quickcheckout.class.php';

		$this->quickCheckout = new quickCheckout($this->modx);
		//$this->addCss($this->quickCheckout->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->quickCheckout->config['jsUrl'] . 'mgr/quickcheckout.js');
		$this->addHtml('
		<script type="text/javascript">
			quickCheckout.config = ' . $this->modx->toJSON($this->quickCheckout->config) . ';
			quickCheckout.config.connector_url = "' . $this->quickCheckout->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('quickcheckout:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends quickCheckoutMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}