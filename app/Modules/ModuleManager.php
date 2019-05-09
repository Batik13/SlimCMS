<?

namespace App\Modules;

class ModuleManager {

  public function get() {
    $modules = [];
    $dirList = scandir(__DIR__);

    for ($i=0; $i < count($dirList); $i++) {
      $dirName = $dirList[$i];

      $pos = strpos($dirName, '.');
      if ($pos === false) {
        $config = file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . 'config.json' );
        $data = json_decode($config);

        $modules[$dirName] = [
          'dirName' => $dirName,
          'adminController' => 'Admin'. $dirName .'Controller',
          'siteController' => 'Site'. $dirName .'Controller',
          'model' => "App\\Modules\\{$dirName}\\Models\\{$data->name}",
          'config' => $data
        ];
      }
    }

    return $modules;
  }

}
