<?php

class msOrderStatusRemoveProcessor extends modObjectRemoveProcessor  {
	public $classKey = 'quickCheckoutStatus';
	public $languageTopics = array('quickcheckout');


	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}

}
return 'msOrderStatusRemoveProcessor';