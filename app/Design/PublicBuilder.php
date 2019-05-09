<?

namespace App\Design;

use App\Modules\Shorts\ModelFilterBuilder\ShortFilter;
use App\Modules\Options\ModelFilterBuilder\OptionFilter;


class PublicBuilder {

  protected $data;

  public function __construct( $data ) {
    $this->data = $data;
  }

  public function sidebar( $query ) {
    $str;
    $format = '
      <div class="post-thumb">
        <div class="post-thumb__title"><a href="%1$s">%2$s</a></div>
        <div class="post-thumb__content">%3$s</div>
      </div>';

    foreach ($query as $value) {
      $href = $this->data->app->router->pathFor('page', ['slug' => $value->url]);
      $str .= sprintf($format, $href, $value->name, $value->min_text);
    }

    return htmlspecialchars_decode($str);
  }

  public function search() {
    return '
      <div class="page__container">
        <div class="page__row">
          <form class="form  form--search" action="'. $this->data->app->router->pathFor('product.search') .'">
            <div class="form__inner">
              <label class="field-text  field-text--search">
                <span class="field-text__input-wrap">
                  <input class="field-text__input" type="text" name="q" placeholder="Поиск" id="search"/>
                </span>
              </label>
              <button class="btn  btn--search-submit" type="submit">
                <i class="icon  icon--search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>';
  }

  public function map() {
    return '
      <div class="map map--home">
        '. OptionFilter::code('map') .'
      </div>';
  }

}