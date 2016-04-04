<?php

/**
 * Create an Item
 */
class quickCheckoutItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'quickCheckoutOrder';
	public $classKey = 'quickCheckoutOrder';
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
        /*
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_ae'));
		}
        */
		return parent::beforeSet();
	}

}

return 'quickCheckoutItemCreateProcessor';