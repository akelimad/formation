<?php

namespace App;

class Asset
{
  public static $json = null;

  public static function path($file)
  {
    $parts = explode('.', $file);
    if (self::isLocal()) {
      if ($parts[1] === 'css') {
        return;
      }
      // $webpack_port = (isset($_COOKIE['webpack_port'])) ? $_COOKIE['webpack_port'] : 3033;
      return 'http://localhost:3003/assets/dynamic/'.$file;
    }
    if (! self::$json) {
      self::$json = json_decode(file_get_contents(public_path().'/assets/dynamic/assets.json'));
    }

    return self::$json->{$parts[0]}->{$parts[1]};
  }

  public static function isLocal()
  {
    return strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;
  }
}
