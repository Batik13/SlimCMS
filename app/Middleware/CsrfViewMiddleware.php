<?

namespace App\Middleware;

class CsrfViewMiddleware extends Middleware {

	public function __invoke( $request, $response, $next ) {
		$csrf = $this->container->csrf;

		$this->container->view->addAttribute('csrf', [
			'field' => '
				<input type="hidden" id="'. $csrf->getTokenNameKey() .'" name="'. $csrf->getTokenNameKey() .'" value="'. $csrf->getTokenName() .'">
        <input type="hidden" id="'. $csrf->getTokenValueKey() .'" name="'. $csrf->getTokenValueKey() .'" value="'. $csrf->getTokenValue() .'">
			',
		]);

		$response = $next($request, $response);
		return $response;
	}
}