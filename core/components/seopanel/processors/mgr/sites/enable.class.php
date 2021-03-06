<?php

/**
 * Enable an Sites
 */
class seoPanelSitesEnableProcessor extends modObjectProcessor {
	public $objectType = 'object';
	public $classKey = 'seoPanelSites';
	public $languageTopics = array('seopanel');
	//public $permission = 'save';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('seopanel_sites_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var seoPanelSites $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('seopanel_sites_err_nf'));
			}

			$object->set('active', true);
			$object->save();
		}

		return $this->success();
	}

}

return 'seoPanelSitesEnableProcessor';
