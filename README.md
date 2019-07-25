# Rotary ☎
**Simplify working with phone numbers.**

[![Build Status](https://travis-ci.org/alwaysblank/rotary.svg?branch=master)](https://travis-ci.org/alwaysblank/rotary)

## Warning ⚠

Currently this project supports *only* simple US numbers—that is numbers in the format of `nnn nnn-nnnn` or `nnn-nnnn`. If you pass it something else you will probably get very strange results.

## Usage 💪

Although all the internal behaviors are easily accessible (with the exception of the `Number` class, all methods are available as static methods), in general, you'll just be using these methods from the `Render` class:

- `pretty` will result in `(123) 456-7890` or `456-7890`.
- `simple` will result in `123 456-7890` or `456-7890`.
- `href` will result in `tel:+11234567890` or `tel:+14567890`.
- `normalized` will result in `1234567890` or `567890`.

You can call them like this:

```php
echo Render::pretty('1234567890');
// (123) 456-7890

echo Render::pretty('123 456 7890');
// (123) 456-7890

echo Render::pretty('[123)    456/7890');
// (123) 456-7890
```

**Note:** Rotary will try and interpret strange arguments but it has limits, so please try and pass it numbers that make sense. 🙏