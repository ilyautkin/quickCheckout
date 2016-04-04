<?php

/**
 * Update an Item
 */
class quickCheckoutItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'quickCheckoutOrder';
	public $classKey = 'quickCheckoutOrder';
	public $languageTopics = array('quickcheckout');
    protected $status;
	//public $permission = 'save';
    

	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return bool|string
	 */
	public function beforeSave() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$id = (int)$this->getProperty('id');
		$name = trim($this->getProperty('name'));
        foreach (array('status') as $v) {
            $this->$v = $this->object->get($v);
            if (!$this->getProperty($v)) {
                $this->addFieldError($v, $this->modx->lexicon('ms2_err_ns'));
            }
        }
        return parent::beforeSet();
		if (empty($id)) {
			return $this->modx->lexicon('quickcheckout_item_err_ns');
		}

        /*
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name, 'id:!=' => $id))) {
			$this->modx->error->addField('name', $this->modx->lexicon('quickcheckout_item_err_ae'));
		}
        */

		return parent::beforeSet();
	}
}

return 'quickCheckoutItemUpdateProcessor';
