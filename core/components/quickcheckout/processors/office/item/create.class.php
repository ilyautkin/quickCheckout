<?php

/**
 * Create an Item
 */
class quickCheckoutOfficeItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'quickCheckoutItem';
	public $classKey = 'quickCheckoutItem';
	public $languageTopics = array('quickcheckout');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'quickCheckoutOfficeItemCreateProcessor';