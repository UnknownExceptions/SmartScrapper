# PHP Smart Scraper

[![Latest Stable Version](https://poser.pugx.org/refactors/smart-scraper/v/stable)](https://packagist.org/packages/refactors/smart-scraper) 
[![Total Downloads](https://poser.pugx.org/refactors/smart-scraper/downloads)](https://packagist.org/packages/refactors/smart-scraper) [![Latest Unstable Version](https://poser.pugx.org/refactors/smart-scraper/v/unstable)](https://packagist.org/packages/refactors/smart-scraper) 
[![License](https://poser.pugx.org/refactors/smart-scraper/license)](https://packagist.org/packages/refactors/smart-scraper)

Smart Scraper is a PHP scraper to scrape information from web pages. It can help you doing that horrible task in a very easy and smart way.

## Installation

Smart Scrapper needs PHP 5.6.0+ and you can use it via Composer:

```composer require refactores/smart-scraper```

## Usage

Create a Smart Scraper instance:

```php
$scraper = new SmartScraper\Parser($theUrlYouWantToScrape);
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
