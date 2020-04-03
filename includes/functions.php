<?php
//functions for HawkEYE
//Coded By R3D
function getTitle($url) {
  $data = readcontents($url);
  $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
  return $title;
  }
  function userinput($message){
    global $white, $bold, $greenbg, $redbg, $bluebg, $cln, $lblue, $fgreen;
    $yellowbg = "\e[100m";
    $inputstyle = $cln . $bold . $lblue . "[#] " . $message . ": " . $fgreen ;
  echo $inputstyle;
  }
function WEBserver($urlws){
  stream_context_set_default( [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
  $wsheaders = get_headers($urlws, 1);
  if (is_array($wsheaders['Server'])) { $ws = $wsheaders['Server'][0];}else{
    $ws = $wsheaders['Server'];
  }
  if ($ws == "")
    {
      echo "\e[91mამოცნობა ვერ მოხერხდა\e[0m";
    }
  else
    {
      echo "\e[92m$ws \e[0m";
    }
}


function cloudflaredetect($reallink){

  $urlhh    = "http://api.hackertarget.com/httpheaders/?q=" . $reallink;
  $resulthh = file_get_contents($urlhh);
  if (strpos($resulthh, 'cloudflare') !== false)
    {
      echo "\e[91mაყენია\n\e[0m";
    }
  else
    {
      echo "\e[92mარ აყენია\n\e[0m";
    }
}


function CMSdetect($reallink){
  $cmssc  = readcontents($reallink);
  if (strpos($cmssc, '/wp-content/') !== false)
    {
      $tcms = "WordPress";

    }
  else
    {
      if (strpos($cmssc, 'Joomla') !== false)
        {
          $tcms = "Joomla";
        }
      else
        {
          $drpurl = $reallink . "/misc/drupal.js";
          $drpsc  = readcontents("$drpurl");
          if (strpos($drpsc, 'Drupal') !== false)
            {
              $tcms = "Drupal";
            }
          else
            {
              if (strpos($cmssc, '/skin/frontend/') !== false)
                {
                  $tcms = "Magento";
                }
              else
                {
                  if (strpos($cmssc, 'content="WordPress')!== false) {
                    $tcms = "WordPress";
                  }
                  else {


                  $tcms = "\e[91mამოცნობა ვერ მოხერხდა";
                }
                }
            }
        }
    }
    return $tcms;
}
function robotsdottxt($reallink){
  $rbturl    = $reallink . "/robots.txt";
  $rbthandle = curl_init($rbturl);
  curl_setopt($rbthandle, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($rbthandle, CURLOPT_RETURNTRANSFER, TRUE);
  $rbtresponse = curl_exec($rbthandle);
  $rbthttpCode = curl_getinfo($rbthandle, CURLINFO_HTTP_CODE);
  if ($rbthttpCode == 200)
    {
      $rbtcontent = readcontents($rbturl);
      if ($rbtcontent == "")
        {
          echo "ნაპოვნია მაგრამ ცარიელია!";
        }
      else
        {
          echo "\e[92mნაპოვნია \e[0m\n";
          echo "\e[36m\n+++++++++++++[შიგთავსი]++++++++++++++++  \e[0m\n";
          echo $rbtcontent;
          echo "\e[36m\n-------------[შიგთავსი]----------------  \e[0m\n";
        }
    }
  else
    {
      echo "\e[91m ვერ მოიძებნა! \e[0m\n";
    }
}
function gethttpheader($reallink){
  $hdr = get_headers($reallink);
  foreach ($hdr as $shdr) {
    echo "\n\e[92m\e[1m[i]\e[0m  $shdr";
  }
  echo "\n";

}
function readcontents($urltoread){
  $arrContextOptions=array(
      "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $filecntns = file_get_contents($urltoread, false, stream_context_create($arrContextOptions));
    return $filecntns;
}

function MXlookup ($site){
  $Mxlkp = dns_get_record($site, DNS_MX);
	$mxrcrd = $Mxlkp[0]['target'];
	$mxip = gethostbyname($mxrcrd);
	$mx = gethostbyaddr($mxip);
  $mxresult = "\e[1m\e[36mIP      :\e[32m " . $mxip ."\n\e[36mHOSTNAME:\e[32m " . $mx ;
  return $mxresult;
}

?>
