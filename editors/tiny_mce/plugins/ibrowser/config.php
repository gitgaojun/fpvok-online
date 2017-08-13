<?php 
// ================================================
// tinymce PHP WYSIWYG editor control
// ================================================
// Configuration file
// ================================================
// Developed: j-cons.com, mail@j-cons.com
// Copyright: j-cons (c)2004 All rights reserved.
// ------------------------------------------------
//                                   www.j-cons.com
// ================================================
// v.1.0, 2004-10-04
// ================================================

// directory where tinymce files are located
$tinyMCE_dir = '';

// base url for images
$tinyMCE_base_url = '';

if (!ereg('/$', $HTTP_SERVER_VARS['DOCUMENT_ROOT']))
  $tinyMCE_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'].$tinyMCE_dir;
else
  $tinyMCE_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'].substr($tinyMCE_dir,1,strlen($tinyMCE_dir)-1);  

// image library related config

// allowed extentions for uploaded image files
$tinyMCE_valid_imgs = array('gif', 'jpg', 'jpeg', 'png');

// allow upload in image library:
$tinyMCE_upload_allowed = false;

// allow delete in image library
$tinyMCE_img_delete_allowed = false;


// image libraries
//  array(
//    'value'   => '',
//    'text'    => 'not configured',
//  ),
// );
// file to include in img_library.php (useful for setting $tinyMCE_imglibs dynamically
// $tinyMCE_imglib_include = '';
?>