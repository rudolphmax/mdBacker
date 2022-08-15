<?php
chdir( $_SERVER['DOCUMENT_ROOT'] );
require('bootstrap.php');

if (!isset($_GET['p'])) {
  throw new PageException( 404 );
}

$pagePath = $_GET['p'];
$pagePath = (mb_substr($pagePath, -1) !== '/') ? $pagePath : substr($pagePath, 0, -1); // removing trailing slash (if existing)
$pagePathArray = explode('/', $pagePath);
$pageName = $pagePathArray[ count($pagePathArray)-1 ];

chdir(locPages);
foreach( $pagePathArray as $page ) {
  
  if (!file_exists($page) ) {
    throw new PageException( 404 );
  }

}
chdir(ROOTPATH); // Changing back to the system-root

/*
Setting up the page
*/
$page = new Page(
  $pageName,
  locPages.$pagePath
);
if ($page) {
  $page->insert();
} else {
  throw $page;
}
?>