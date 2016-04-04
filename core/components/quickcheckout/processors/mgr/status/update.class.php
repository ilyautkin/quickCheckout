<?php

class quickCheckoutStatusUpdateProcessor extends modObjectUpdateProcessor {
	public $classKey = 'quickCheckoutStatus';
	public $languageTopics = array('msOrderStatus');


	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}


	/** {@inheritDoc} */
	public function beforeSet() {
		if ($this->modx->getObject('quickCheckoutStatus',array('name' => $this->getProperty('name'), 'id:!=' => $this->getProperty('id') ))) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_name'));
		}
		return parent::beforeSet();
	}

}

return 'quickCheckoutStatusUpdateProcessor';