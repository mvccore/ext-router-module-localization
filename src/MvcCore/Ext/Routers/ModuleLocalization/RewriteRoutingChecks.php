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

trait RewriteRoutingChecks {

	/**
	 * Return `TRUE` if there is possible (or not) by additional info array 
	 * records to route incoming request by given route as first argument. 
	 * Check, if route object has defined any http method and if the request has 
	 * the same method or not, check if route has defined any allowed module and 
	 * if routed module name is presented in allowed module names array and 
	 * check if route object is localized route instance and if there is also 
	 * any localization found in request. If there is a conflict, return 
	 * `FALSE`, if there is everything OK, return `TRUE`.
	 * @param \MvcCore\Route $route 
	 * @param array $additionalInfo 
	 *				Array with request method as string, localization found in 
	 *				request as bool, route is localized as bool and boolean 
	 *				about not skip localized routes matching when request has no 
	 *				localization in path and other conditions described inside 
	 *				this function.
	 * @return bool
	 */
	protected function rewriteRoutingCheckRoute (\MvcCore\IRoute $route, array $additionalInfo) {
		/** @var $this \MvcCore\Ext\Routers\ModuleLocalization */
		list ($requestMethod, $localizationInRequest, $routeIsLocalized, $localizationRoutesSkipping) = $additionalInfo;

		$routeMethod = $route->GetMethod();
		if ($routeMethod !== NULL && $routeMethod !== $requestMethod) return TRUE;

		$modules = $route->GetAdvancedConfigProperty(\MvcCore\Ext\Routers\Modules\IRoute::CONFIG_ALLOWED_MODULES);
		if (is_array($modules) && !in_array($this->currentModule, $modules)) return TRUE;

		// skip localized routes matching when request has no localization in path
		if ($routeIsLocalized && $localizationInRequest === FALSE) {
			// but do not skip localized routes matching when request has no localization in path and:
			// - when method is post and router has not allowed to process other methods than GET
			// - or when method is anything and router has allowed to process other methods than GET
			if ($localizationRoutesSkipping) return TRUE;
		}

		if ($routeIsLocalized === FALSE && isset($this->allowNonLocalizedRoutes) && $this->allowNonLocalizedRoutes === FALSE) 
			return TRUE;

		return FALSE;
	}
}
