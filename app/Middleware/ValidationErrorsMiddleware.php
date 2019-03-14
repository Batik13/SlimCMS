<?

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware {
	public function __invoke( $request, $response, $next ) {

		$this->container->view->addAttribute('errors', $_SESSION['errors']);
		unset($_SESSION['errors']);


		$response = $next($request, $response);
		return $response;
	}
}