<?php

namespace Faanigee\DbLogger\Helpers;

class JsonFormatter
{
  public static function formatJsonForDisplay($json)
  {
    if (is_string($json)) {
      $json = json_decode($json);
    }

    $json = json_encode($json, JSON_PRETTY_PRINT);

    // Add spans with appropriate classes
    $json = preg_replace('/\"(.*?)\":/', '<span class="json-key">"$1"</span>:', $json);
    $json = preg_replace('/:(\s*)\"(.*?)\"([,}\]])/', ':<span class="json-string">"$2"</span>$3', $json);
    $json = preg_replace('/:(\s*)(null)([,}\]])/', ':<span class="json-null">$2</span>$3', $json);
    $json = preg_replace('/:(\s*)(true|false)([,}\]])/', ':<span class="json-boolean">$2</span>$3', $json);
    $json = preg_replace('/:(\s*)(\d+)([,}\]])/', ':<span class="json-number">$2</span>$3', $json);

    return $json;
  }
}
