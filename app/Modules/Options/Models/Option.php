<?

namespace App\Modules\Options\Models;

use Illuminate\Database\Eloquent\Model;
use App\Functions\Functions as f;

class Option extends Model {

  protected $table = 'options';

  // for created
  protected $fillable = [
    'namespace',
    'tab',
    'name',
    'description',
    'value',
    'type',
    'code',
    'values',
  ];

  public function getValueAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setValueAttribute($value) {
    $this->attributes['value'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getName() {
    return ['option', 'Опции'];
  }

  public function updateDynamicField( $request ) {
    $unnecessaryFields = ['namespace', 'csrf_name', 'csrf_value'];
    $arguments = $request->getParams();
    $namespace = $arguments['namespace'];

    foreach ($unnecessaryFields as $value) {
      if (array_key_exists($value, $arguments)) {
        unset($arguments[$value]);
      }
    }

    $arguments = (object) $arguments;
    foreach ($arguments as $key => $value) {
      self::where('namespace', $namespace)
        ->where('code', $key)
        ->update(['value' => $value]);
    }
  }

}
