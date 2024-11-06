<?php

/**
 * get the defined config value by a key
 * @param string $key
 * @return config value
 */
if (!function_exists('get_setting')) {

  function get_setting($key = "")
  {
    $ci = get_instance();
    return $ci->config->item($key);
  }

}

function isDemo()
{
  $is_demo = get_setting("is_demo");
  if ($is_demo) {
    $ci =& get_instance();
    $ci->session->set_flashdata("warning", "Some CRUD or Settings Are not allowed in demo!");
  }
  return $is_demo;
}

function ewodie($data, $die = false)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";

  if ($die)
    die();

}


function getBaseUrl()
{
//    $ci=&get_instance();
  return base_url();
}


//GCM function
function Send_GCM_msg($registration_id, $data)
{
  $data1['data'] = $data;

  $url = 'https://fcm.googleapis.com/fcm/send';

  $registatoin_ids = array($registration_id);
  // $message = array($data);

  $fields = array(
    'registration_ids' => $registatoin_ids,
    'data'             => $data1,
  );

  $headers = array(
    'Authorization: key=' . APP_GCM_KEY . '',
    'Content-Type: application/json',
  );
  // Open connection
  $ch = curl_init();

  // Set the url, number of POST vars, POST data
  curl_setopt($ch, CURLOPT_URL, $url);

  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Disabling SSL Certificate support temporarly
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

  // Execute post
  $result = curl_exec($ch);
  if ($result === false) {
    die('Curl failed: ' . curl_error($ch));
  }

  // Close connection
  curl_close($ch);
  //echo $result;exit;
}


function time_Ago($time)
{

  // Calculate difference between current
  // time and given timestamp in seconds
  $diff = time() - $time;

  // Time difference in seconds
  $sec = $diff;

  // Convert time difference in minutes
  $min = round($diff / 60);

  // Convert time difference in hours
  $hrs = round($diff / 3600);

  // Convert time difference in days
  $days = round($diff / 86400);

  // Convert time difference in weeks
  $weeks = round($diff / 604800);

  // Convert time difference in months
  $mnths = round($diff / 2600640);

  // Convert time difference in years
  $yrs = round($diff / 31207680);

  // Check for seconds
  if ($sec <= 60) {
    return "$sec seconds ago";
  } // Check for minutes
  elseif ($min <= 60) {
    if ($min == 1) {
      return "one minute ago";
    }
    else {
      return "$min minutes ago";
    }
  } // Check for hours
  elseif ($hrs <= 24) {
    if ($hrs == 1) {
      return "an hour ago";
    }
    else {
      return "$hrs hours ago";
    }
  } // Check for days
  elseif ($days <= 7) {
    if ($days == 1) {
      return "Yesterday";
    }
    else {
      return "$days days ago";
    }
  } // Check for weeks
  elseif ($weeks <= 4.3) {
    if ($weeks == 1) {
      return "a week ago";
    }
    else {
      return "$weeks weeks ago";
    }
  } // Check for months
  elseif ($mnths <= 12) {
    if ($mnths == 1) {
      return "a month ago";
    }
    else {
      return "$mnths months ago";
    }
  } // Check for years
  else {
    if ($yrs == 1) {
      return "one year ago";
    }
    else {
      return "$yrs years ago";
    }
  }
}


//Image compress
function compress_image($source_url, $destination_url, $quality)
{

  $info = getimagesize($source_url);

  if ($info['mime'] == 'image/jpeg')
    $image = imagecreatefromjpeg($source_url);

  elseif ($info['mime'] == 'image/gif')
    $image = imagecreatefromgif($source_url);

  elseif ($info['mime'] == 'image/png')
    $image = imagecreatefrompng($source_url);

  imagejpeg($image, $destination_url, $quality);
  return $destination_url;
}

//Create Thumb Image
function create_thumb_image($target_folder = '', $thumb_folder = '', $thumb_width = '', $thumb_height = '')
{
  //folder path setup
  $target_path = $target_folder;
  $thumb_path  = $thumb_folder;


  $thumbnail    = $thumb_path;
  $upload_image = $target_path;

  list($width, $height) = getimagesize($upload_image);
  $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
  switch (@$file_ext) {
    case 'jpg':
      $source = imagecreatefromjpeg($upload_image);
      break;
    case 'png':
      $source = imagecreatefrompng($upload_image);
      break;
    case 'gif':
      $source = imagecreatefromgif($upload_image);
      break;
    default:
      $source = imagecreatefromjpeg($upload_image);
  }
  imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
  switch (@$file_ext) {
    case 'jpg' || 'jpeg':
      imagejpeg($thumb_create, $thumbnail, 80);
      break;
    case 'png':
      imagepng($thumb_create, $thumbnail, 80);
      break;
    case 'gif':
      imagegif($thumb_create, $thumbnail, 80);
      break;
    default:
      imagejpeg($thumb_create, $thumbnail, 80);
  }
}


function date_to_db($ui_date)
{
  $temp = explode('/', $ui_date);
  //  die(print_r($temp[0]));
  $db_date = $temp[2] . '-' . $temp[1] . '-' . $temp[0];
  //  die($db_date);
  return $db_date;
}

function date_to_ui($db_date)
{
//    echo $db_date;
//    die();
  $temp    = explode('-', $db_date);
  $ui_date = $temp[2] . '/' . $temp[1] . '/' . $temp[0];
  return $ui_date;
}

function limit_text($text, $limit)
{
  if (str_word_count($text, 0) > $limit) {
    $words = str_word_count($text, 2);
    $pos   = array_keys($words);
    $text  = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}
