<?

namespace App\Modules\_Source\Factory;

class FilterFactory {

  protected $isNotShortcodes = false;
  protected $container;
  protected $content;

  public function __construct( $content, $container ) {
    $this->content = $content;
    $this->container = $container;
  }

  public function __toString() {
    $this->content = $this->recursivelyReplace();

    if ($this->isNotShortcodes) {
      $this->content = $this->recursivelyReplace();
    }

    return $this->content;
  }

  function recursivelyReplace() {
    $regexpFormat = '/{{.+}}/Uu';
    $pregResult = preg_match_all($regexpFormat, $this->content, $shorts);

    foreach ($shorts[0] as $value) {
      $short = explode(' ', substr($value, 2, -2));

      switch ($short[0]) {
        case 'base':
          $this->content = (string) new \App\Modules\_Source\ModelFilterBuilder\BaseFilter($this->content, $short, $this->container);
          break;

        case 'short':
          $this->content = (string) new \App\Modules\Shorts\ModelFilterBuilder\ShortFilter($this->content, $short, $this->container);
          break;

        case 'option':
          $this->content = (string) new \App\Modules\Options\ModelFilterBuilder\OptionFilter($this->content, $short, $this->container);
          break;

        case 'slider':
          $this->content = (string) new \App\Modules\Sliders\ModelFilterBuilder\SliderFilter($this->content, $short, $this->container);
          break;

        case 'article':
          $this->content = (string) new \App\Modules\Articles\ModelFilterBuilder\ArticleFilter($this->content, $short, $this->container);
          break;

        default:
          # code...
          break;
      }

      /*$modules = $this->container->mm->get();
      foreach ($modules as $key => $value) {
        if ($key[0] !== '_') {
          if ($short[0] === $value['config']->short->name) {
            // $filterClassName = '\App\Modules\\'.$value['dirName'].'\ModelFilterBuilder\\'.$value['dirName'].'Filter';
            // $this->content = (string) new $value['config']->short->className($this->content, $short, $this->container);
          }
        }
      }*/

    }

    $pregResult = preg_match_all($regexpFormat, $this->content, $shorts);
    if ($pregResult) {
      $this->isNotShortcodes = true;
    }    

    return $this->content;
  }

}