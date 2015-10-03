<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>
  <head>
    <title>Aviation Weather</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
     pre { white-space:pre-wrap; }
     h2 { margin:0; }
     input { font-size:large; }
    </style>
   </head>
   <body>
     <h2>Aviation Weather</h2>
     <hr />
<?php

if ( isset($_REQUEST['icao']) ) {
    $metar_url = "ftp://tgftp.nws.noaa.gov/data/observations/metar/stations/".strtoupper($_REQUEST['icao']).".TXT";
    $taf_url = "ftp://tgftp.nws.noaa.gov/data/forecasts/taf/stations/".strtoupper($_REQUEST['icao']).".TXT";

    if ( $metar_handle = @fopen($metar_url, "r") ) {
        $metar = stream_get_contents($metar_handle);
        fclose($metar_handle);
        echo "    <pre>$metar</pre>\n";

        echo "    <hr />\n";

        if ( $taf_handle = @fopen($taf_url, "r") ) {
            $taf = stream_get_contents($taf_handle);
            fclose($taf_handle);
            echo "    <pre>$taf</pre>\n";
        }
        else echo "  <pre>No TAF</pre>\n";

    }
    else echo "  <pre>METAR Unavailable</pre>\n";

/*
 $metar = curl_init();
 curl_setopt($metar, CURLOPT_URL, $metar_url);
 curl_setopt($metar, CURLOPT_HEADER, 0);
 curl_exec($metar);
 curl_close($metar);
*/

} else { ?>
    <form action="" method="get">
    <table>
      <tr>
        <td>ICAO:</td>
        <td><input type="text" name="icao" size="10" autocorrect="off" /></td>
        <td><input type="submit" value="Lookup" /></td>
      </tr>
    </table>
    </form>
<?php } ?>
  </body>
</html>
