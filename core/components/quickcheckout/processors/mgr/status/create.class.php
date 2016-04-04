<?php

class quickCheckoutStatusCreateProcessor extends modObjectCreateProcessor {
	public $classKey = 'quickCheckoutStatus';
	public $languageTopics = array('quickcheckout');


	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}


	/** {@inheritDoc} */
	public function beforeSet() {
		if ($this->modx->getObject('quickCheckoutStatus',array('name' => $this->getProperty('name')))) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_name'));
		}
		return !$this->hasErrors();
	}


	/** {@inheritDoc} */
	public function beforeSave() {
		$this->object->fromArray(array(
			'rank' => $this->modx->getCount('quickCheckoutStatus')
		));
		return parent::beforeSave();
	}

}

return 'quickCheckoutStatusCreateProcessor';