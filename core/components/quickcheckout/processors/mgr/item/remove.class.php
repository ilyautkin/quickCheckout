<?php

/**
 * Remove an Items
 */
class quickCheckoutItemRemoveProcessor extends modObjectProcessor {
	public $objectType = 'quickCheckoutOrder';
	public $classKey = 'quickCheckoutOrder';
	public $languageTopics = array('quickcheckout');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('quickcheckout_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var quickCheckoutOrder $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('quickcheckout_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'quickCheckoutItemRemoveProcessor';