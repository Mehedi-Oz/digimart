<?php

namespace App\Services;

class NotificationService
{
  static function CREATED($message = null)
  {
    notyf()->success($message ?? __('Created Successfully'));
  }

  static function UPDATED($message = null)
  {
    notyf()->success($message ?? __('Updated Successfully'));
  }

  static function DELETED($message = null)
  {
    notyf()->success($message ?? __('Deleted Successfully'));
  }

  static function ERROR($message = null)
  {
    notyf()->error($message ?? __('Something went wrong!'));
  }
}
