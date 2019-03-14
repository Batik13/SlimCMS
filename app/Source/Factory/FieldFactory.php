<?

namespace App\Source\Factory;

use App\Source\ModelFieldBuilder\TextareaField;
use App\Source\ModelFieldBuilder\SelectField;
use App\Source\ModelFieldBuilder\HiddenField;
use App\Source\ModelFieldBuilder\TextField;

class FieldFactory {

  public static function getField( $obj ) {
    $obj = (object) $obj;

    switch ($obj->type) {
      case 'textarea':
        return new TextareaField($obj);
        break;
      case 'select':
        return new SelectField($obj);
        break;
      case 'hidden':
        return new HiddenField($obj);
        break;
      default:
        return new TextField($obj);
        break;
    }
  }

}