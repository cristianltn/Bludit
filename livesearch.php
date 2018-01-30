<?php
libxml_disable_entity_loader(false);
function pathUrl($dir = __DIR__){

    $root = "";
    $dir = str_replace('\\', '/', realpath($dir));


    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';


    $root .= '://' . $_SERVER['HTTP_HOST'];


    if(!empty($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER[ 'CONTEXT_DOCUMENT_ROOT' ]));
    } else {
        $root .= substr($dir, strlen($_SERVER[ 'DOCUMENT_ROOT' ]));
    }

    $root .= '/';

    return $root;
}
$rootsite = pathUrl();
$ccc = ($_SERVER[ 'DOCUMENT_ROOT' ]);
$xmlDoc=new DOMDocument();
$xmlDoc->load($ccc."/rss.xml");

$x=$xmlDoc->getElementsByTagName('item');

$q=$_GET["q"];

if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('title');
    $z=$x->item($i)->getElementsByTagName('link');
    if ($y->item(0)->nodeType==1) {
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if ($hint=="") {
          $hint="&bull; <a href='" . 
          $z->item(0)->childNodes->item(0)->nodeValue . 
          "'>" . 
          $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        } else {
          $hint=$hint . "<br />&bull; <a href='" . 
          $z->item(0)->childNodes->item(0)->nodeValue . 
          "'>" . 
          $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      }
    }
  }
}

if ($hint=="") {
  $response="No suggestionn";
} else {
  $response=$hint;
}

echo $response;
?>