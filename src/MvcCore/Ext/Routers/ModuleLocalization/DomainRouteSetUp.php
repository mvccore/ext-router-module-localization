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
	protected function domainRoutingSetUpRouterByDomainRoute () {
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
