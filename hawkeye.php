<?php
//Coded By R3D
//2020/31/მარტი

error_reporting(0);
require 'includes/functions.php';
require 'includes/var.php';
echo $cln;
system("clear");
redhawk_banner();
if (extension_loaded('curl') || extension_loaded('dom'))
  {
  }
else
  {
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "\n[-] ერთი მოდული არ არის დაინსტალირებული „cURL“ აკრიფეთ 'შესწორება' რათა დაყენდეს ავტომატურად" . $cln;
      }
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "\n[-] ერთი მოდული არ არის დაინსტალირებული „PHP-XML“ აკრიფეთ 'შესწორება' რათა დაყენდეს ავტომატურად\n" . $cln;
      }
  }
thephuckinstart:
echo "\n";
userinput("მიუთითე ვებ-გვერდის მისამართი \e[91m\e[1m(magalitad.ge / www.magalitad.ge)$cln");
$ip = trim(fgets(STDIN, 1024));
if ($ip == "შესწორება")
  {
    echo "\n\e[91m\e[1m[+] ავტომატური საინსტალაციო მენიუ [+]\n\n$cln";
    echo $bold . $blue . "[+] მოწმდება გთხოვ მოიცადო...\n";
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "[-] „cURL“ არ არის დაყენებული ! \n";
        echo $yellow . "[+] მიმდინარეობს ინსტალაცია. (გთხოვ მიუთითო პაროლი რათა მოხდეს მოდულის დაყენება) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-curl");
        echo $bold . $fgreen . "\t[+] „cURL“ დაყენებულია. \n";
      }
    else
      {
      echo $bold . $fgreen . "[+] „cURL“ დაყენებულია \n";
      }
    echo $bold . $blue . "[-] მოწმდება გთხოვ მოიცადო...\n";
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "[-] „PHP-XML“ არ არის დაყენებული ! \n";
        echo $yellow . "[+] მიმდინარეობს ინსტალაცია. (გთხოვ მიუთითო პაროლი რათა მოხდეს მოდულის დაყენება) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-xml");
        echo $bold . $fgreen . "[+] „PHP-XML“ დაყენებულია. \n";
      }
    else
      {
        echo $bold . $fgreen . "[+] „PHP-XML“ დაყენებულია. \n";
      }
    echo $bold . $fgreen . "[+] გთხოვ ხელახლა გაუშვით პროგრამა \n";
    exit;
  }
elseif (strpos($ip, '://') !== false)
  {
    echo $bold . $red . "\n[-] (HTTP/HTTPS) შეცდომა! მიუთითეთ ვებ-გვერდის მისამართი Http/Https გამოყენების გარეშე\n" . $CURLOPT_RETURNTRANSFER;
    goto thephuckinstart;
  }
elseif (strpos($ip, '.') == false)
  {
    echo $bold . $red . "\n[-] არასწორი ვებ-გვერდის მისამართი! მიუთითეთ სწორი ვებ-გვერდის მისამართი\n" . $cln;
    goto thephuckinstart;
  }
elseif (strpos($ip, ' ') !== false)
  {
    echo $bold . $red . "\n[-] არასწორი ვებ-გვერდის მისამართი! მიუთითეთ სწორი ვებ-გვერდის მისამართი\n" . $cln;
    goto thephuckinstart;
  }
else
  {
    echo "\n";
    userinput("1 = HTTP; 2 = HTTPS");
    echo $cln . $bold . $fgreen;
    $ipsl = trim(fgets(STDIN, 1024));
    if ($ipsl == "2")
      {
        $ipsl = "https://";
      }
    else
      {
        $ipsl = "http://";
      }
scanlist:

    system("clear");
    redhawk_banner();
    echo $bold . $blue . "
            $lblue ვებ-გვერდის მისამართი: " . $fgreen . $ipsl . $ip . $blue . "\n\n";
    echo $yellow . " 
     [1]  ზედაპირული სკანირება
     [2]  სერვერის ადგილმდებარეობა  
     [3]  ვებ-გვერდის მიმღები ლიცენზია  
     [4]  DNS სკანირება  
     [5]  NMAP ღია პორტების სკანირება  
     [6]  ქვედომენების სკანირება  
     [7]  SQLi შეცდომების სკანირება$white (იპოვე გაბაგული ლინკები)$yellow  
     [8]  WordPress სკანირება$white (თუ საიტი აწყობილია WordPress ძრავზე)$yellow  
     [9]  დამალული ფალების/საქაღალდეების სკანირება  
     [10] MX ძებნა $magenta 
     [B]  უკან (სხვა ვებ-გვერდის არჩევა) $red 
     [Q]  გასვლა \n\n" . $cln;
askscan: 
    userinput("აირჩიე ჩამოთვლილთაგან");
    $scan = trim(fgets(STDIN, 1024));
      echo "\n";
    if (!in_array($scan, array(
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        'B',
        'Q',
        'b',
        'q',
    ), true))
      {
        echo $bold . $red . "\n[-] არასწორია მოდული! აირჩიე ჩამოთვლილთაგან! \n\n" . $cln;
        goto askscan;
      }
    else
      {
        if ($scan == "15")
          {
            goto thephuckinstart;
          }
        elseif ($scan == 'q' | $scan == 'Q')
          {
            echo "## მშვიდობიან დღეს გისურვებ ნახვამდის ## \n\n\n";
            die();
          }
        elseif ($scan == 'b' || $scan == 'B')
          {
            system("clear");
            goto thephuckinstart;
          }
        elseif ($scan == "1")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo $bold . $lblue . "[+] საიტის სახელი: " . $green;
            echo getTitle($reallink);
            echo $cln;
            $wip = gethostbyname($ip);
            echo $lblue . $bold . "\n[+] IP მისამართი: " . $green . $wip . "\n" . $cln;
            echo $bold . $lblue . "[+] სერვერი: ";
            WEBserver($reallink);
            echo "\n";
            echo $bold . $lblue . "[+] ძრავი: \e[92m" . CMSdetect($reallink) . $cln;
            echo $lblue . $bold . "\n[+] Cloudflare: ";
            cloudflaredetect($lwwww);
            echo $lblue . $bold . "[+] Robots:$cln ";
            robotsdottxt($reallink);
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "2")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            $urlgip    = "http://api.hackertarget.com/geoip/?q=" . $lwwww;
            $resultgip = readcontents($urlgip);
            $geoips    = explode("\n", $resultgip);
            foreach ($geoips as $geoip)
              {
                echo $bold . "$green $geoip \n";
              }
              echo "\n";
              echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
              trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "3")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            $hdr = get_headers($reallink);
            foreach ($hdr as $shdr)
              {
                echo $bold . $lblue . $green . $shdr . "\n";
              }
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "4")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            $urldlup    = "http://api.hackertarget.com/dnslookup/?q=" . $lwwww;
            $resultdlup = readcontents($urldlup);
            $dnslookups = trim($resultdlup, "\n");
            $dnslookups = explode("\n", $dnslookups);
            foreach ($dnslookups as $dnslkup)
              {
                echo $bold . $green . $dnslkup . "\n";
              }
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "6")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            $urlsd      = "http://api.hackertarget.com/hostsearch/?q=" . $lwwww;
            $resultsd   = readcontents($urlsd);
            $subdomains = trim($resultsd, "\n");
            $subdomains = explode("\n", $subdomains);
            unset($subdomains['0']);
            $sdcount = count($subdomains);
            echo "\n" . $blue . $bold . "[+] მოიძებნა " . $green . $sdcount . $cln . $blue . $bold . " ქვედომენი" . $cln . "\n\n";
            foreach ($subdomains as $subdomain)
              {
                echo $bold . $lblue . "[+] ქვედომენი: $fgreen" . (str_replace(",", "\n\e[36m[+] IP მისამართი: $fgreen", $subdomain));
                echo "\n------------------------------------\n" . $cln;
              }
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "5")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            $urlnmap    = "http://api.hackertarget.com/nmap/?q=" . $lwwww;
            $resultnmap = readcontents($urlnmap);
            echo $bold . $fgreen . $resultnmap;
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "7")
          {
            $reallink = $ipsl . $ip;
            $srccd    = file_get_contents($reallink);
            $lwwww    = str_replace("www.", "", $ip);
            $lulzurl = $reallink;
            $html    = file_get_contents($lulzurl);
            $dom     = new DOMDocument;
            @$dom->loadHTML($html);
            $links = $dom->getElementsByTagName('a');
            $vlnk  = 0;
            foreach ($links as $link)
              {
                $lol = $link->getAttribute('href');
                if (strpos($lol, '?') !== false)
                  {
                    echo $lblue . $bold . "[+] " . $fgreen . $lol . "\n" . $cln;
                    echo $blue . $bold . "[+] ";
                    $sqllist = file_get_contents('includes/sqlerrors.ini');
                    $sqlist  = explode(',', $sqllist);
                    if (strpos($lol, '://') !== false)
                      {
                        $sqlurl = $lol . "'";
                      }
                    else
                      {
                        $sqlurl = $ipsl . $ip . "/" . $lol . "'";
                      }
                    $sqlsc = file_get_contents($sqlurl);
                    $sqlvn = $bold . $red . "დაცულია";
                    foreach ($sqlist as $sqli)
                      {
                        if (strpos($sqlsc, $sqli) !== false)
                            $sqlvn = $green . $bold . "დაუცველი!";
                      }
                    echo $sqlvn;
                    echo "\n\n$cln";
                    $vlnk++;
                  }
              }
            echo $blue . $bold . "[+] სულ მოიძებნა: " . $green . $vlnk . $blue . $bold . " მისამართი " . $cln;
            echo "\n\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "8")
          {
            $reallink = $ipsl . $ip;
            echo $bold . $blue . "[+] მოწმდება საიტი არის თუარა WordPress ძრავზე: ";
            $srccd = readcontents($reallink);
            if (strpos($srccd, "wp-content") !== false)
              {
                echo $fgreen . "საიტი არის WordPress ძრავზე!" . $cln . "\n";
                $wp_rm_src = readcontents($reallink . "/readme.html");
                if (strpos($wp_rm_src, "Welcome. WordPress is a very special project to me.") !== false)
                  {
                    echo $fgreen . "[+] Readme ნაპოვნია, მისამართი: " . $reallink . "/readme.html\n";
                  }
                else
                  {
                    echo $red . "[-] Readme ვერ მოიძებნა!\n";
                  }
                $wp_lic_src = readcontents($reallink . "/license.txt");
                if (strpos($wp_lic_src, "WordPress - Web publishing software") !== false)
                  {
                    echo $fgreen . "[+] ლიცენზია ნაპოვნია, მისამართი: " . $reallink . "/license.txt\n";
                  }
                else
                  {
                    echo $red . "[-] ლიცენზია ვერ მოიძებნა!\n";
                  }
                $wp_updir_src = readcontents($reallink . "/wp-content/uploads/");
                if (strpos($wp_updir_src, "Index of /wp-content/uploads") !== false)
                  {
                    echo $fgreen ."[+] მისამართზე ". $reallink . "/wp-content/uploads შეგიძლიათ იხილით ფაილები\n";
                  }
                $wp_xmlrpc_src = readcontents($reallink . "/xmlrpc.php");
                if (strpos($wp_xmlrpc_src, "XML-RPC server accepts POST requests only.") !== false)
                  {
                    echo $fgreen . "[+] XML-RPC ნაპოვნია, მისამართი: " . $reallink . "/xmlrpc.php\n";
                  }
                else
                  {
                    echo $red . "[-] XML-RPC ვერ მოიძებნა\n";
                  }
                echo $bold . $blue . "[+] WordPress ვერსია: ";
                $metaver = preg_match('/<meta name="generator" content="WordPress (.*?)\"/ims', $srccd, $matches) ? $matches[1] : null;
                if ($metaver != "")
                  {
                    echo $fgreen . "მოიძებნა [პირველი მეთოდით]" . "\n";
                    echo $blue . "[+] ვერსია: " . $fgreen . $metaver . $cln;
                    $wp_version   = str_replace(".", "", $metaver);
                    $wp_c_version = $metaver;
                  }
                else
                  {
                    $feedsrc = readcontents($reallink . "/feed/");
                    $feedver = preg_match('#<generator>http://wordpress.org/\?v=(.*?)</generator>#ims', $feedsrc, $matches) ? $matches[1] : null;
                    if ($feedver != "")
                      {
                        echo $fgreen . "მოიძებნა [მეორე მეთოდით]" . "\n";
                        echo $blue . "[+] ვერსია: " . $fgreen . $feedver . $cln;
                        $wp_version   = str_replace(".", "", $feedver);
                        $wp_c_version = $feedver;
                      }
                    else
                      {
                        $lopmlsrc = readcontents($reallink . "/wp-links-opml.php");
                        $lopmlver = preg_match('#generator="wordpress/(.*?)"#ims', $feedsrc, $matches) ? $matches[1] : null;
                        if ($lopmlver != "")
                          {
                            echo $fgreen . "მოიძებნა [მესამე მეთოდით]" . "\n";
                            echo $blue . "[+] ვერსია: " . $fgreen . $lopmlver . $cln;
                            $wp_version   = str_replace(".", "", $lopmlver);
                            $wp_c_version = $lopmlver;
                          }
                      }
                  }
                if ($wp_version != "")
                  {
                    $vuln_json = readcontents("https://wpvulndb.com/api/v2/wordpresses/" . $wp_version);
                    if (strpos($vuln_json, "The page you were looking for doesn't exist (404)") !== false)
                      {
                        echo $red . "[-] ვერსიის ინფრომაცია ვერ მოიძებნა\n";
                      }
                    else
                      {
                        $vuln_array = json_decode($vuln_json, TRUE);
                        echo $blue . "\n[+] გამოშვების თარიღი   : " . $fgreen . $vuln_array[$wp_c_version]["release_date"] . "\n";
                        echo $blue . "[+] ბაგები              : " . $fgreen . count($vuln_array[$wp_c_version]["vulnerabilities"]) . "\n";
                        if (count($vuln_array[$wp_c_version]["vulnerabilities"]) != "0")
                          {
                            $ver_vuln_array = $vuln_array[$wp_c_version]['vulnerabilities'];
                            foreach ($ver_vuln_array as $vuln_s)
                              {
                                echo $lblue . "[+] ბაგის სახელი          : " . $fgreen . $vuln_s["title"] . "\n";
                                echo $lblue . "[+] ბაგის სახეობა         : " . $fgreen . $vuln_s["vuln_type"] . "\n";
                                echo $lblue . "[+] გასწორებულია ვერსიაში : " . $fgreen . $vuln_s["fixed_in"] . "\n";
                                echo $lblue . "[+] ბაგის ლინკი           : " . $fgreen . "http://wpvulndb.com/vulnerabilities/" . $vuln_s['id'] . "\n";
                                foreach ($vuln_s['references']["cve"] as $wp_cve)
                                  {
                                    echo $lblue . "[+] Vuln CVE            : " . $fgreen . "http://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-" . $wp_cve . "\n";
                                  }
                                foreach ($vuln_s['references']['exploitdb'] as $wp_edb)
                                  {
                                    echo $lblue . "[+] ExploitDB მისამართი : " . $fgreen . "http://www.exploit-db.com/exploits/" . $wp_edb . "\n";
                                  }
                                foreach ($vuln_s['references']['metasploit'] as $wp_metas)
                                  {
                                    echo $lblue . "[+] Metasploit მოდული   : " . $fgreen . "http://www.metasploit.com/modules/" . $wp_metas . "\n";
                                  }
                                foreach ($vuln_s['references']['osvdb'] as $wp_osvdb)
                                  {
                                    echo $lblue . "[+] OSVDB მისამართი     : " . $fgreen . "http://osvdb.org/" . $wp_osvdb . "\n";
                                  }
                                foreach ($vuln_s['references']['secunia'] as $wp_secu)
                                  {
                                    echo $lblue . "[+] Secunia მისამართი   : " . $fgreen . "http://secunia.com/advisories/" . $wp_secu . "\n";
                                  }
                                foreach ($vuln_s['references']["url"] as $vuln_ref)
                                  {
                                    echo $lblue . "[+] Vuln ინფორმაცია     : " . $fgreen . $vuln_ref . "\n";
                                  }
                                echo "\n\n";
                              }
                          }
                      }
                    $reallink = $ipsl . $ip;
                    echo "\n";
                    echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
                    trim(fgets(STDIN, 1024));
                    goto scanlist;
                  }
                else
                  {
                    $reallink = $ipsl . $ip;
                    echo $red . "შეცდომა \n\n[-] WordPress-ის ვერსია ვერ მოიძებნა ";
                    echo "\n";
                    echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
                    trim(fgets(STDIN, 1024));
                    goto scanlist;
                  }
              }
            else
              {
                $reallink = $ipsl . $ip;
                echo $red . "შეცდომა \n\n[-] ვებ-გვერდი არ არის WordPress ძრავზე";
                echo "\n";
                echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
                trim(fgets(STDIN, 1024));
                goto scanlist;
              }
          }
        elseif ($scan == "9")
          {
            echo $bold . $blue . "\n[+] მიმდინარეობს ფაილების ჩატვირთვა....\n" . $cln;
            if (file_exists("finder/admin.list"))
              {
                echo $bold . $fgreen . "\n[+] სამართავი პანელის ფაილი მოიძებნა. ვეძებთ სამართავ პანელს\n" . $cln;
                $crawllnk = file_get_contents("finder/admin.list");
                $crawls   = explode(',', $crawllnk);
                echo "ჩაიტვირთა " . count($crawls) . " ლინკი\n";
                foreach ($crawls as $crawl)
                  {
                    $url    = $ipsl . $ip . "/" . $crawl;
                    $handle = curl_init($url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($handle);
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200)
                      {
                        echo $bold . $lblue . "\n[+] $url: " . $cln;
                        echo $bold . $fgreen . "ნაპოვნია" . $cln;
                      }
                    elseif ($httpCode == 404)
                      {
                        echo $bold . $lblue . "\n[-] $url: " . $cln;
                        echo $bold . $fgreen . "გვერდი არ არსებობს" . $cln;
                      }
                    elseif ($httpCode == 302)
                      {
                        echo $bold . $lblue . "\n[+] $url: " . $cln;
                        echo $bold . $fgreen . "გვერდი გადამისამართდა" . $cln;
                      }
                    else
                      {
                        echo $bold . $lblue . "\n[-] $url: " . $cln;
                        echo $bold . $yellow . "HTTP პასუხი: " . $httpCode . $cln;
                      }
                    curl_close($handle);
                  }
              }
            else
              {
                echo "\n ფაილი ვერ მოიძებნა....\n";
              }
            if (file_exists("finder/backup.list"))
              {
                echo "\n[+] სარეზერვო ასლების ფაილი მოიძებნა\n";
                $crawllnk = file_get_contents("finder/backup.list");
                $crawls   = explode(',', $crawllnk);
                echo "ჩაიტვირთა " . count($crawls) . " ლინკი\n";
                foreach ($crawls as $crawl)
                  {
                    $url    = $ipsl . $ip . "/" . $crawl;
                    $handle = curl_init($url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($handle);
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200)
                      {
                        echo $bold . $lblue . "\n[+] $url: " . $cln;
                        echo $bold . $fgreen . "ნაპოვნია" . $cln;
                      }
                    elseif ($httpCode == 404)
                      {
                        echo $bold . $lblue . "\n[-] $url: " . $cln;
                        echo $bold . $fgreen . "გვერდი არ არსებობს" . $cln;
                      }
                    else
                      {
                        echo $bold . $lblue . "\n[-] $url: " . $cln;
                        echo $bold . $yellow . "HTTP პასუხი: " . $httpCode . $cln;
                      }
                    curl_close($handle);
                  }
              }
            else
              {
                echo "\n ფაილი ვერ მოიძებნა....\n";
              }
            if (file_exists("finder/others.list"))
              {
                echo "\n[+] მტავარი ფაილი მოიძებნა\n";
                $crawllnk = file_get_contents("finder/others.list");
                $crawls   = explode(',', $crawllnk);
                echo "\nURLs Loaded: " . count($crawls) . "\n\n";
                foreach ($crawls as $crawl)
                  {
                    $url    = $ipsl . $ip . "/" . $crawl;
                    $handle = curl_init($url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($handle);
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200)
                      {
                        echo $bold . $lblue . "\n[+] $url: " . $cln;
                        echo $bold . $fgreen . "ნაპოვნია" . $cln;
                      }
                    elseif ($httpCode == 404)
                      {
                        echo $bold . $lblue . "\n[-] $url: " . $cln;
                        echo $bold . $fgreen . "გვერდი არ არსებობს" . $cln;
                      }
                    else
                      {
                        echo $bold . $lblue . "\n[-] $url: " . $cln;
                        echo $bold . $yellow . "HTTP პასუხი: " . $httpCode . $cln;
                      }
                    curl_close($handle);
                  }
              }
            else
              {
                echo "\n ფაილი ვერ მოიძებნა....\n";
              }
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "10")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo MXlookup($lwwww);
            echo "\n";
            echo $bold . $yellow . "[-] სკანირება დასრულებულია. დააჭირე 'ENTER' გაგრძელებისთვის";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
      }
  }
?>
