# MvcCore - Extension - Router - Modules With Localization

[![Latest Stable Version](https://img.shields.io/badge/Stable-v5.0.1-brightgreen.svg?style=plastic)](https://github.com/mvccore/ext-router-module-localization/releases)
[![License](https://img.shields.io/badge/License-BSD%203-brightgreen.svg?style=plastic)](https://mvccore.github.io/docs/mvccore/5.0.0/LICENSE.md)
![PHP Version](https://img.shields.io/badge/PHP->=5.4-brightgreen.svg?style=plastic)

MvcCore Router extension to manage multiple websites in single project and to manage website localizations (language or language and locale, optionaly contained in URL address domain part or in URL address beinning), defined by domain routes, targeted by module property in URL completing.  

This router is the way, how to route your requests in domain level with localization with params or variable sections, namespaces, default param values and more.

## Outline  
1. [Installation](#user-content-1-installation)  
2. [Features](#user-content-2-features)  
3. [How It Works](#user-content-3-how-it-works)  
4. [Usage](#user-content-4-usage)  

## 1. Installation
```shell
composer require mvccore/ext-router-module-localization
```

[go to top](#user-content-outline)

## 2. Features
Extension has the same features as extensions bellow together:
- [Features for `mvccore/ext-router-module`](https://github.com/mvccore/ext-router-module#user-content-2-features)
- [Features for `mvccore/ext-router-localization`](https://github.com/mvccore/ext-router-localization#user-content-2-features)

Localization could be contained in any module domain route as param named `<localization>` match URL requests like this:
- `http://example.com/anything`
- `http://en.example.com/anything`
- `http://en-US.example.com/anything`
- `http://de-DE.example.com/anything`
```php
new \MvcCore\Ext\Routers\Modules\Route([
    "pattern"              => "//[<localization>.]example.com",
    "module"               => "main",
    "constraints"          => ["localization" => "-a-zA-Z"],
]);
```
If there is not contained param `<localization>` in matched module domain route pattern and matched route (or route to generate URL) is defined as localized route, localization param has to be contained (or is automaticly inserted) in URL address beginning like this:
- `http://example.com/anything`
- `http://example.com/en/anything`
- `http://example.com/en-US/anything`
- `http://example.com/de-DE/anything`
How precisely is conained in URL address depends on advanced router configuration like allowed languages and more...

[go to top](#user-content-outline)

## 3. How It Works

Extension works in the same way as extensions bellow together:
- [How It Works - `mvccore/ext-router-module`](https://github.com/mvccore/ext-router-module#user-content-3-how-it-works)
- [How It Works - `mvccore/ext-router-localization`](https://github.com/mvccore/ext-router-localization#user-content-3-how-it-works)

Router is composed from traits in extensions named above.

[go to top](#user-content-outline)

## 4. Usage

### Usage - `Bootstrap` Initialization

Add this to `/App/Bootstrap.php` or to **very application beginning**, 
before application routing or any other extension configuration
using router for any purposes:

```php
$app = \MvcCore\Application::GetInstance();
$app->SetRouterClass('\MvcCore\Ext\Routers\ModuleLocalization');
...
// to get router instance for next configuration:
/** @var \MvcCore\Ext\Routers\ModuleLocalization $router */
$router = \MvcCore\Router::GetInstance();
```

All other specific usage and advanced configuration is the same as extensions bellow together:
- [More usage and configuration for `mvccore/ext-router-module`](https://github.com/mvccore/ext-router-module#user-content-42-usage---targeting-custom-application-part)
- [More usage and configuration for `mvccore/ext-router-localization`](https://github.com/mvccore/ext-router-localization#user-content-42-usage---default-localization)

[go to top](#user-content-outline)
