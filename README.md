# PHP Smart Scrapper

[![Latest Stable Version](https://poser.pugx.org/refactors/smart-scrapper/v/stable)](https://packagist.org/packages/refactors/smart-scrapper) 
[![Total Downloads](https://poser.pugx.org/refactors/smart-scrapper/downloads)](https://packagist.org/packages/refactors/smart-scrapper) [![Latest Unstable Version](https://poser.pugx.org/refactors/smart-scrapper/v/unstable)](https://packagist.org/packages/refactors/smart-scrapper) 
[![License](https://poser.pugx.org/refactors/smart-scrapper/license)](https://packagist.org/packages/refactors/smart-scrapper)

Smart Scraper is a PHP scraper to scrape information from web pages. It can help you doing that horrible task in a very easy and smart way.

## Installation

Smart Scrapper needs PHP 5.6.0+ and you can use it via Composer:

```composer require fabpot/goutte```

## Usage

Create a Smart Scrapper instance:

```php
$scraper = new SmartScrapper\Parser($theUrlYouWantToScrape);
```
Then, if you want to save the text of some selector, you should use:

```php
$scraper->saveText($name, $expression, [$attribute = null]);
```

The value is saved on ```$scraper->{$name}```. Example:

```php
$scraper->saveText( 'nick', '.header h1' );
echo $scraper->nick;
```

If you just want to receive the HTML you must use:

```php
$scraper->saveHtml($name, $expression, [$index = 0]);
```

The ```$index``` referes to the position of the element in the page in the case of having more than one.
