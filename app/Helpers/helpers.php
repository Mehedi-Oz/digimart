<?php

use Illuminate\Support\Facades\Auth;

/* Get logged in user */

if (! function_exists('user')) {
  function user()
  {
    return Auth::guard('web')->user();
  }
}
