# Rotary ☎
**Simplify working with phone numbers.**

[![Build Status](https://travis-ci.org/alwaysblank/rotary.svg?branch=master)](https://travis-ci.org/alwaysblank/rotary)

## Warning ⚠

Rotary will support numbers that look like the standard number format used in the United State of America, i.e. `nnn-nnnn` or `nnn nnn-nnnn`. These can also be prepended with an international country code up to 5 digit long, i.e. `nn nnn nnn-nnnn`. Numbers that deviate from this pattern cannot be reliably interpreted.

## Usage 💪

Although all the internal behaviors are easily accessible (with the exception of the `Number` class, all methods are available as static methods), in general, you'll just be using these methods from the `Render` class:

- `pretty` will result in `(123) 456-7890` or `456-7890`.
- `simple` will result in `123 456-7890` or `456-7890`.
- `href` will result in `tel:+11234567890` or `tel:+14567890`.
- `normalized` will result in `1234567890` or `567890`.

You can call them like this:

```php
use AlwaysBlank\Rotary\Render;

echo Render::pretty('1234567890');
// (123) 456-7890

echo Render::pretty('123 456 7890');
// (123) 456-7890

echo Render::pretty('[123)    456/7890');
// (123) 456-7890
```

You can also instantiate a `Rotary` object, which has methods for the different format types:

```php
use AlwaysBlank\Rotary\Rotary;

$Rotary = new Rotary('123456789');
echo $Rotary->pretty();
// (123) 456-7890
```

This can be useful if you want access to several formats on one number.

> You can put any non-digit characters you like in your argument and Rotary will simply ignore them--it cares only for digits. `234-5678` and `2dfsad__34-5)(6=78` are identical so far as it's concerned.

**Note:** Rotary will try to interpret strange arguments, but it has limits, so please try to pass it numbers that make sense. 🙏
