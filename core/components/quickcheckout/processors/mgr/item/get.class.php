<?php

/**
 * Get an Item
 */
class quickCheckoutItemGetProcessor extends modObjectGetProcessor {
	public $objectType = 'quickCheckoutOrder';
	public $classKey = 'quickCheckoutOrder';
	public $languageTopics = array('quickcheckout:default');
	//public $permission = 'view';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return mixed
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		return parent::process();
	}

}

return 'quickCheckoutItemGetProcessor';