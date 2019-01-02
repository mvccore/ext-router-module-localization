# MvcCore Extension - Router - Modules With Localization

[![Latest Stable Version](https://img.shields.io/badge/Stable-v4.3.1-brightgreen.svg?style=plastic)](https://github.com/mvccore/ext-router-module-localization/releases)
[![License](https://img.shields.io/badge/Licence-BSD-brightgreen.svg?style=plastic)](https://mvccore.github.io/docs/mvccore/4.0.0/LICENCE.md)
![PHP Version](https://img.shields.io/badge/PHP->=5.3-brightgreen.svg?style=plastic)

MvcCore Router extension to manage multiple websites in single project and to manage website localizations (language or language and locale, optionaly contained in URL address domain part or in URL address beinning), defined by domain routes, targeted by module property in URL completing.  
This router is the way, how to route your requests in domain level with localization with params or variable sections, namespaces, default param values and more.

## Outline  
1. [Installation](#user-content-1-installation)  
2. [Features](#user-content-2-features)  
3. [How It Works](#user-content-3-how-it-works)  
4. [Usage](#user-content-4-usage)  
    4.1. [Usage - `Bootstrap` Initialization](#user-content-41-usage---bootstrap-initialization)  
	4.2. [Usage - Targeting Custom Application Part](#user-content-42-usage---targeting-custom-application-part)  
    4.3. [Usage - Creating Module Domain Route](#user-content-43-usage---creating-module-domain-route)  
    4.4. [Usage - Domain Routes And Standard Routes Definition](#user-content-44-usage---domain-routes-and-standard-routes-definition)  


## Installation
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
If there is not contained param `<localization>` in module domain pattern, localization is automatically contained in URL address beginning like this:
- `http://example.com/anything`
- `http://example.com/en/anything`
- `http://example.com/en-US/anything`
- `http://example.com/de-DE/anything`
How precisely is conained in URL address depends on advanced router configuration like allowed languages and more...

[go to top](#user-content-outline)

## 3. How It Works



[go to top](#user-content-outline)

## 4. Usage



[go to top](#user-content-outline)
