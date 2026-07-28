# Frontend JavaScript Conventions

## Structure

All frontend JS is wrapped in an IIFE with jQuery: `(function ($) { "use strict"; ... })(jQuery);`

All DOM-ready code goes inside `$(document).ready(function () { ... });`

## Event Handling

Use jQuery `.on()` — never inline handlers or `.click()`:

```js
$('.toggle-mobileMenu').on('click', function () { ... });
$('body').on('click', function () { ... });  // delegated/global dismiss
```

## Active State Pattern

Toggle UI states with `.addClass('active')` / `.removeClass('active')` / `.toggleClass('active')`.

## Section Comments

```js
// ============================== Feature Name Js Start ==============================
// ... code ...
// ============================== Feature Name Js End ==============================
```

## Slider Configuration

```js
prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
```

Always include `responsive` breakpoints: 1199, 991, 767, 575 (and 425 for very small).

## Guard Against Missing Elements

```js
if (document.querySelector('.countdown')) { ... }
if ($('ul').length) { ... }
var chartElement = document.querySelector("#chart");
if (chartElement) { ... }
```
