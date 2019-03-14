<?

namespace App\Source\Factory;

use App\Source\ModelFilterBuilder\ShortFilter;
use App\Source\ModelFilterBuilder\OptionFilter;
use App\Source\ModelFilterBuilder\ReviewFilter;

class FilterFactory {

  protected $content;
  protected $isNotShortcodes = false;

  public function __construct( $content ) {
    $this->content = $content;
  }

  public function __toString() {
    $this->content = $this->recursivelyReplace();

    if ($this->isNotShortcodes) {
      $this->content = $this->recursivelyReplace();
    }

    return $this->content;
  }

  function recursivelyReplace() {
    $regexpFormat = '/\w+ \w+/u';
    $pregResult = preg_match_all($regexpFormat, $this->content, $shorts);

    foreach ($shorts[0] as $value) {
      $short = explode(' ', $value);

      switch ($short[0]) {
        case 'short':
          $this->content = (string) new ShortFilter($this->content, $short);
          break;

        case 'option':
          $this->content = (string) new OptionFilter($this->content, $short);
          break;

        case 'review':
          $this->content = (string) new ReviewFilter($this->content, $short);
          break;

        default:
          # code...
          break;
      }
    }

    $pregResult = preg_match_all($regexpFormat, $this->content, $shorts);
    if ($pregResult) {
      $this->isNotShortcodes = true;
    }    

    return $this->content;
  }

}