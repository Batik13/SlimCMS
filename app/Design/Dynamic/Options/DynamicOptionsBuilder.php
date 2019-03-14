<?

namespace App\Design\Dynamic\Options;

use App\Source\Factory\FieldFactory;
use App\Modules\Options\Models\Option;

class DynamicOptionsBuilder {

  protected $namespace;
  protected $resultQuery;
  protected $tabs = [];

  public function __construct( $namespace ) {
    $this->namespace = $namespace;
    $this->resultQuery = Option::where('namespace', '=', $namespace)->get();
  }

  public function __toString() {
    $str .= $this->getNavTabs();
    $str .= $this->getTabPanel();
    $str .= $this->getHiddenField();
    $str .= $this->getSubmitButton();

    return $str;
  }

  function getNavTabs() {
    $str;

    foreach ($this->resultQuery as $value) {
      array_push($this->tabs, $value->tab);
    }
    $this->tabs = array_values(array_unique($this->tabs));

    for ($i=0; $i < count($this->tabs); $i++) { 
      $active = (!$i) ? 'active' : '';
      $str .= sprintf('<li class="nav-item">
          <a class="nav-link %s" data-toggle="tab" href="#tab-%s" aria-controls="tab-%s" >%s</a>
        </li>', $active, $i, $i, $this->tabs[$i]);
    }

    return sprintf('<ul class="nav nav-tabs" role="tablist">%s</ul>', $str);
  }

  function getTabPanel() {
    $str;

    for ($i=0; $i < count($this->tabs); $i++) { 
      $active = (!$i) ? 'active' : '';
      $str .= sprintf('<div class="tab-pane %s" id="tab-%s" role="tabpanel">', $active, $i);

        foreach ($this->resultQuery as $value) {
          if ($this->tabs[$i] == $value->tab) {
            $str .= FieldFactory::getField($value);
          }
        }

      $str .= '</div>';
    }

    return sprintf('<div class="tab-content">%s</div>', $str);
  }

  function getSubmitButton() {
    $str = '
      <div class="card">
        <div class="card-footer btn-toolbar justify-content-between">
          <button class="btn btn-sm btn-primary" type="submit">
            <i class="fa fa-dot-circle-o"></i> Сохранить</button>
        </div>
      </div>';

    return $str;
  }

  function getHiddenField() {
    return FieldFactory::getField([
      'type' => 'hidden',
      'code' => 'namespace',
      'value' => $this->namespace,
    ]);
  }

}