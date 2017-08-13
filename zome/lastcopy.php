<?php
function copydir($strSrcDir, $strDstDir)  
{  
    $dir = opendir($strSrcDir);  
    if (!$dir) {  
        return false;  
    }  
    if (!is_dir($strDstDir)) {  
        if (!mkdir($strDstDir)) {  
            return false;  
        }  
    }  
    while (false !== ($file = readdir($dir))) {  
        if (($file!='.') && ($file!='..')) {  
            if (is_dir($strSrcDir.'/'.$file) ) {  
                if (!copydir($strSrcDir.'/'.$file, $strDstDir.'/'.$file)) {  
                    return false;  
                }  
            } else {  
                if (!copy($strSrcDir.'/'.$file, $strDstDir.'/'.$file)) {  
                    return false;  
                }  
            }  
        }  
    }  
    closedir($dir);  
    return true;  
}  
  
$pdDate				=date("Ym");
copydir("../images/l/".$pdDate, "../images/v/".$pdDate);  
copydir("../images/l/".$pdDate, "../images/s/".$pdDate);  
Echo "Copy successful ! "
 ?>