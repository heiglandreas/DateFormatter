# DateFormatter

[![Build Status](https://travis-ci.org/heiglandreas/DateFormatter.svg?branch=master)](https://travis-ci.org/heiglandreas/DateFormatter)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/heiglandreas/DateFormatter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/heiglandreas/DateFormatter/?branch=master)


Extendable Library to format DateTimes using Zend-Frameworks Date-Constants

## Installation

```composer require org_heigl/date-formatter```

## Usage

```php

use Org_Heigl\DateFormatter\FormatterFacade as Formatter;

$date = new DateTime('2013-12-03 12:23:34', new DateTimeZone('Europe/Berlin'));

echo Formatter::format($date, 'PDF');
// Prints "20131203122334+01'00'"
```

Currently the following formatters are available:

* PDF
* ATOM
* COOKIE
* RFC_822
* RFC_850
* RFC_1036
* RFC_1123
* RFC_3339
* RSS
* W3C
* MYSQL

## Extending

You can add your own formatter by creating a class that implements the
```Org_Heigl\DateFormatter\Formatter\FormatterInterface```. This class 
can then either be used directly like in this example:

```php
use Org_Heigl\DateFormatter\DateFormatter as Formatter;

$formatter = new Formatter(new MyCoolClassImplementingFormatterInterface());

$date = new DateTime('2013-12-03 12:23:34', new DateTimeZone('Europe/Berlin'));

echo $formatter->format($date);
// Prints whatever you formatted the given date to ;)
```

To be able to use it with the ```FormatterFacade``` you have to announce the
Folder containing the formatter to the class like in this example:

```php
use Org_Heigl\DateFormatter\FormatterFacade as Formatter;

// Announce the Folder containing your formatter to the class
Formatter::addFormatterFolder('/absolute/Path/To/Your/Formatter/Folder');

$date = new DateTime('2013-12-03 12:23:34', new DateTimeZone('Europe/Berlin'));

echo Formatter::format($date, 'WhateverYouCalledYourFormatter');
// Prints WhateverYourFormatterDoes ;)
```

> Self-Defined formatters will always be called instead of default formatters. So
when you have a formatter for "PDF" in your added folder that formatter will be
called instead of the default formatter!

