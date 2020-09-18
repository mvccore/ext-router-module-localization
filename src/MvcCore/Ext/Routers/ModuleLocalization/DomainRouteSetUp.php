<?php

/**
 * MvcCore
 *
 * This source file is subject to the BSD 3 License
 * For the full copyright and license information, please view
 * the LICENSE.md file that are distributed with this source code.
 *
 * @copyright	Copyright (c) 2016 Tom Flídr (https://github.com/mvccore/mvccore)
 * @license		https://mvccore.github.io/docs/mvccore/4.0.0/LICENCE.md
 */

namespace MvcCore\Ext\Routers\ModuleLocalization;

trait DomainRouteSetUp
{
	/**
	 * This method is executed after module domain routing is done and before 
	 * standard routing. So there could be already routed/defined current module 
	 * domain route and that route could contain additional configuration for 
	 * normal routing. This method is the place where to put special values 
	 * from module domain route into router before standard routing. 
	 * If there is defined in module domain route any constructor property
	 * `allowedLocalizations`, then allowed localizations in router is defined
	 * by this route property value. If there is also any `localization` param
	 * in default params array, call localization router method to prepare 
	 * request localization property.
	 * @return void
	 */
	protected function domainRoutingSetUpRouterByDomainRoute () {
		/** @var $this \MvcCore\Ext\Routers\ModuleLocalization */
		// if domain route contains any allowed localizations configuration,
		// set up router by this configuration
		$allowedLocalizations = $this->currentDomainRoute->GetAdvancedConfigProperty(
			\MvcCore\Ext\Routers\Modules\IRoute::CONFIG_ALLOWED_LOCALIZATIONS
		);
		if (is_array($allowedLocalizations)) {
			$this->SetAllowedLocalizations($allowedLocalizations);
			foreach ($this->localizationEquivalents as $localizationEquivalent => $allowedLocalization) 
				if (!isset($this->allowedLocalizations[$allowedLocalization]))
					unset($this->localizationEquivalents[$localizationEquivalent]);
			$this->SetDefaultLocalization(current($allowedLocalizations));
		}

		// if domain route contains localization param, 
		// set up request localization if possible,
		// else redirect to default localization
		$localizationUrlParamName = static::URL_PARAM_LOCALIZATION;
		if (isset($this->defaultParams[$localizationUrlParamName])) {
			if (!$this->prepareSetUpRequestLocalizationIfValid(
				$this->defaultParams[$localizationUrlParamName], FALSE
			)) 
				$this->switchUriParamLocalization = implode(static::LANG_AND_LOCALE_SEPARATOR, $this->defaultLocalization);
		}
	}
}
