<?php

namespace Faanigee\DbLogger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingsController extends Controller
{
  public function index()
  {
    $settings = config('dblogger');
    return view('dblogger::settings.index', compact('settings'));
  }

  public function update(Request $request)
  {
    $validated = $request->validate([
      'per_page' => 'required|integer|min:10|max:500',
      'date_format' => 'required|string',
      'enable_filters' => 'required|boolean',
      'dark_mode' => 'required|boolean'
    ]);

    // Update config file
    $config = config('dblogger');
    $config = array_merge($config, $validated);

    // Save to config file
    $configPath = config_path('dblogger.php');
    file_put_contents($configPath, '<?php return ' . var_export($config, true) . ';');

    return redirect()->route('dblogger.settings.index')
      ->with('success', 'Settings updated successfully');
  }
}
