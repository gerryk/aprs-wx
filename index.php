
<?php

ini_set( "user_agent", "gerryk.com (+http://gerryk.com/)" );

function display_wx() {
        $apikey="68595.oouE96tdsxHeXp";
        $json_url="http://api.aprs.fi/api/get?name=EI2GCP-2&what=wx&apikey=".$apikey."&format=json";
        $json = file_get_contents( $json_url, 0, null, null );
        $json_output = json_decode( $json, true);
        $stations = $json_output[ 'entries' ];
        foreach ( $stations as $station ) {
           $name = $station[ 'name' ];
            $direction = $station['wind_direction'];
           if ($direction > 350 || $direction < 10) 
               $heading = "N";
           if ($direction > 80 && $direction < 100) 
               $heading = "W";
           if ($direction > 170 && $direction < 190) 
               $heading = "S";
           if ($direction > 260 && $direction < 280) 
               $heading = "E";
           if ($direction > 10 && $direction < 80) 
               $heading = "NW";
           if ($direction > 100 && $direction < 160) 
               $heading = "SW";
           if ($direction > 190 && $direction < 260) 
               $heading = "SE";
           if ($direction > 280 && $direction < 350) 
               $heading = "NE";
           echo "<h4>WX at ".$name."</h3><br/>";
           echo "<table>";
           echo "<tr><td>Temp:</td><td>".$station['temp']."C</td><tr>";
           echo "<tr><td>Pressure:</td><td>".$station['pressure']."mB</td><tr>";
           echo "<tr><td>Humidity:</td><td>".$station['humidity']."%</td><tr>";
           echo "<tr><td>Wind Direction:</td><td>".$heading."</td><tr>";
           echo "<tr><td>Wind Speed:</td><td>".$station['wind_speed']."m/s</td><tr>";
           echo "<tr><td>Rainfall:</td><td>".$station['rain_mn']."C</td><tr>";
           echo "</table>";
        }
        echo "\n\n";
}

display_wx();

?>

