<?
namespace App\Design;

use App\Design\Dynamic\Options\DynamicOptionsBuilder;

class AdminBuilder {

  public function controls( $listControl ) {
    $str;
    foreach ($listControl as $key => $value) {
      $str .= $this->{$key}($value);
    }

    return $str;
  }

  function edit( $value ) {
    $format = '
      <a class="mr-3" href="%s">
        <i class="fa fa-edit"></i>
      </a>';

    return sprintf($format, $value);
  }

  function delete( $value ) {
    $format = '
      <a class="mr-3"
        href="javascript:void(0)"
        data-index="%s" 
        data-toggle="modal" 
        data-target="#deleteModal">
          <i class="fa fa-trash-o"></i>
      </a>';

    return sprintf($format, $value);
  }


  public function getDynamicField( $namespace ) {
    return new DynamicOptionsBuilder($namespace);
  }

}