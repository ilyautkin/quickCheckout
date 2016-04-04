<?php

class quickCheckoutStatusGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'quickCheckoutStatus';
	public $defaultSortField = 'rank';
	public $defaultSortDirection  = 'asc';


	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}


	/** {@inheritDoc} */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		if ($this->getProperty('combo')) {
			$c->select('id,name');
			$c->where(array('active' => 1));
			if ($order_id = $this->getProperty('order_id')) {
				/* @var msOrder $order */
				if ($order = $this->modx->getObject('quickCheckoutOrder', $order_id)) {
					/* @var quickCheckoutStatus $status */
					$status = $order->getOne('Status');
				}
			}
		}
		return $c;
	}


	/** {@inheritDoc} */
	public function prepareRow(xPDOObject $object) {
		if ($this->getProperty('combo')) {
			$array = array(
				'id' => $object->get('id')
				,'name' => $object->get('name')
			);
		}
		else {
			$array = $object->toArray();
		}
		return $array;
	}


	/** {@inheritDoc} */
	public function outputArray(array $array,$count = false) {
		if ($this->getProperty('addall')) {
			$array = array_merge_recursive(array(array(
				'id' => 0
				,'name' => $this->modx->lexicon('ms2_all')
			)), $array);
		}
		return parent::outputArray($array, $count);
	}

}

return 'quickCheckoutStatusGetListProcessor';