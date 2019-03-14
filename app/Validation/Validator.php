<?

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator {

	protected $errors;

	public function validate( $request, array $rules ) {
		foreach ($rules as $field => $rule) {
			try {
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch (NestedValidationException $e) {

        $e->findMessages([
          'notEmpty'              => '{{name}} обязательно к заполнению.',
          'alpha'                 => '{{name}} должен содержать только буквы.',
          'alnum'                 => '{{name}} должен содержать только буквенно-цифровые символы и тире.',
          'numeric'               => '{{name}} должен содержать только числовые символы.',
          'noWhitespace'          => '{{name}} не должно содержать пробелов.',
          'length'                => 'Длина {{name}} должна быть между {{minValue}} и {{maxValue}}.',
          'email'                 => 'Пожалуйста, убедитесь, что вы ввели правильный адрес электронной почты.',
          'creditCard'            => 'Пожалуйста, убедитесь, что вы ввели правильный номер карты.',
          'date'                  => 'Убедитесь, что вы ввели правильную дату для {{name}} ({{format}}).',
          'password_confirmation' => 'Подтверждение пароля не соответствует.'
        ]);

				$this->errors[$field] = $e->getFullMessage();
			}			
		}

		$_SESSION['errors'] = $this->errors;

		return $this;
	}

	public function failed() {
		return !empty($this->errors);
	}

}