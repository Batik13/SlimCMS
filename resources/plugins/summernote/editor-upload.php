<?

session_start();
isset($_SESSION['user']) or die("Access denied!");

if (isset($_GET['path']) && isset($_GET['moduleName'])) {
  $cyrillicPattern  = array('а','б','в','г','д','е', 'ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ь', 'э', 'ы', 'ю','я','А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ь','Э','Ы','Ю','Я',' ', ',', '.', '/', '(', ')','«','»');
  $latinPattern = array('a','b','v','g','d','e','jo','zh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','ts','ch','sh','sht','','','je','ji','yu','ya','A','B','V','G','D','E','Jo','Zh','Z','I','Y','K','L','M','N','O','P','R','S','T','U','F','H','Ts','Ch','Sh','Sht','','','Je','Ji','Yu','Ya','-','', '', '-', '', '','-','-');

  $allowed = array( 'png', 'jpg', 'gif','zip' );
  $root = $_GET['path'];
  $moduleName = '../../uploads/' . $_GET['moduleName'];
  $uploadsPathGlobal = $root . 'resources/uploads/';
  $errorStr = '{"status":"error"}';


  if( isset($_FILES['file']) && $_FILES['file']['error'] == 0 ) {
    $extension = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION );
    if( !in_array( strtolower( $extension ), $allowed ) ) {
      echo $errorStr;
      exit;
    }

    if (!file_exists($moduleName)) {
      mkdir($moduleName, 0777, true);
    }


    if( move_uploaded_file( $_FILES['file']['tmp_name'], $moduleName . '/' . $_FILES['file']['name'] ) ) {
      $newName = str_replace('.'.$extension, '', $_FILES['file']['name']);
      $newName = strtolower(str_replace($cyrillicPattern, $latinPattern, $newName));
      rename($moduleName . '/' . $_FILES['file']['name'], $moduleName . '/'. $newName . '.' . $extension );
      echo $uploadsPathGlobal . $_FILES['file']['name'];
      exit;
    }

  }

  echo $errorStr;
  exit;
}