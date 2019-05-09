<?

namespace App\Modules\_Source\ModelFilterBuilder;

class BaseFilter extends AFilter{

  public function __construct($content, $short, $container) {
    parent::__construct($content, $short, $container);
  }

  public function __toString() {

    if ($this->short[1] === 'template') {
      $templatePath = $this->container->path['root'] . $this->container->path['view'] . 'public/'. $this->container->settings['public']['template'] .'/';
      $this->content = str_replace($this->shortcode, $templatePath, $this->content);
    }

    return $this->content;
  }

}