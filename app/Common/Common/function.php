<?php
//写入日志
function writelog($name = "", $content = ""){
    if (!$content || !$name) {
        return false;
    }
    $dir = getcwd() . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $name;
    if (!is_dir($dir)) {
        if (!mkdir($dir)) {
            return false;
        }
    }
    $filename = $dir . DIRECTORY_SEPARATOR . date("Ymd", time()) . '.php';
    $logs = (include $filename);
    if ($logs && !is_array($logs)) {
        unlink($filename);
        return false;
    }
    $logs[] = array("time" => date("Y-m-d H:i:s"), "content" => $content);
    $str = "<?php \r\n return " . var_export($logs, true) . ";";
    if (!($fp = @fopen($filename, "wb"))) {
        return false;
    }
    if (!fwrite($fp, $str)) {
        return false;
    }
    fclose($fp);
    return true;
}
//手机端判断
function isMobile(){
    $mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';
    if ($mobile != '') {
        session('ismobile', true);
        return true;
    }
    if (session('ismobile')) {
        return true;
    }
    $host = isset($_SERVER['HTTP_HOST']) ? trim($_SERVER['HTTP_HOST']) : '';
    if ($host != '') {
        $host = explode(".", $host);
        if (in_array('m', $host)) {
            return true;
        }
    }
    $mobile = array();
    static $mobilebrowser_list = 'Mobile|iPhone|Android|WAP|NetFront|JAVA|OperasMini|UC|WindowssCE|Symbian|Series|webOS|SonyEricsson|Sony|BlackBerry|Cellphone|dopod|Nokia|samsung|PalmSource|Xphone|Xda|Smartphone|PIEPlus|MEIZU|MIDP|CLDC';
    if (preg_match("/{$mobilebrowser_list}/i", $_SERVER['HTTP_USER_AGENT'], $mobile)) {
        return true;
    } else {
        if (preg_match('/(mozilla|chrome|safari|opera|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT'])) {
          return false;
        }
    }
}
//验证TIKEN
function cktoken($token){
   if ( !C('TOKEN_ON') ) return true;
   if ( $token!='' ) {
	 $tname     = C('TOKEN_NAME');
	 $token     = explode("_",$token);
	 $tokenname = isset($token[0]) ? $token[0] : '';
	 $tokenval  = isset($token[1]) ? $token[1] : '';
	 if ( $tokenname == '' || $tokenval == '' ) {
	   return false;
	 } else {
	   if ( !isset($_SESSION[$tname]) || !isset($_SESSION[$tname][$tokenname]) || ($_SESSION[$tname][$tokenname] != $tokenval) ) {
		 return false;
	   } else {
	     return true;
	   }
	 }
   } else {
     return false;
   }
}