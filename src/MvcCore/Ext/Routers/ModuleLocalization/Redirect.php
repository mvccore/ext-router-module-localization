<?php

/**
 * MvcCore
 *
 * This source file is subject to the BSD 3 License
 * For the full copyright and license information, please view
 * the LICENSE.md file that are distributed with this source code.
 *
 * @copyright	Copyright (c) 2016 Tom Flidr (https://github.com/mvccore)
 * @license		https://mvccore.github.io/docs/mvccore/5.0.0/LICENSE.md
 */

namespace MvcCore\Ext\Routers\ModuleLocalization;

trait Redirect {

	/**
	 * When request is redirected by router configured behaviour, this method is 
	 * called to correct localization URL value in domain params array.
	 * @param array $domainParams 
	 * @return void
	 */
	protected function redirectCorrectDomainSystemParams (& $domainParams) {
		/** @var $this \MvcCore\Ext\Routers\ModuleLocalization */
		$localizationParamName = static::URL_PARAM_LOCALIZATION;
		if (isset($domainParams[$localizationParamName])) {
			$domainParams[$localizationParamName] = $this->redirectLocalizationGetUrlValueAndUnsetGet(
				$domainParams[$localizationParamName]
			);
		}
	}
}
