<?php
/**
 * Created by PhpStorm.
 * User: leomarbucud
 * Date: 18/09/2016
 * Time: 22:37
 */

/*
 *
 * Successful query
name	    description	        example	        type
status	    always success	    success	        string
country	    country	            United States	string
countryCode	country short	    US	            string
region	    region/state short	CA or 10	    string
regionName	region/state	    California	    string
city	    city	            Mountain View	string
zip	        zip code	        94043	        string
lat	        latitude	        37.4192	        float
lon	        longitude	        -122.0574	    float
timezone	city timezone	    America/Los_Angeles	string
isp	        ISP name	        Google	        string
org	        Organization name	Google	        string
as	        AS number and name, separated by space	AS15169 Google Inc.	string
reverse	    Reverse DNS of the IP	wi-in-f94.1e100.net	string
mobile	    mobile (cellular) connection	true	bool
proxy	    proxy (anonymous)	true	        bool
query	    IP used for the query	173.194.67.94	string


Failed query
name	description	example	type
status	always fail	fail	string
message	error message	reserved range	string
query	IP used for the query	173.194.67.94	string
 */

class Geolocation {

    private $location_api = 'http://ip-api.com/json/%s';

    private $google_developer_api_key = 'AIzaSyBHjM3GK-ChfBpmbsk7RYbnnAYxnLYDH1I';

    //https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-XX&radius=XX&type=XX&name=XX&key=XX
    private $google_place_search = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?%s';

    //https://maps.googleapis.com/maps/api/place/photo?maxwidth=XX&photoreference=XX&key=XX
    private $google_photo = 'https://maps.googleapis.com/maps/api/place/photo?%s';

    public $google_place_radius = 10000; // meters

    public $location_data = null;

    public $fields = null;

    public $default_fields = '';

    public function request($ip) {
        if($this->fields !== null) {
            $this->location_api .= '?fields='.$this->fields;
        }
        $url = sprintf($this->location_api, $ip);
        $this->sendRequest($url);
    }

    public function sendRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        if( $result ) {
            $this->location_data = json_decode($result,true);
        }

    }

    public function nearbyPlaces($lat, $lon, $rad, $type) {

        $url = $this->google_place_search;

        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        if( $result ) {
            $this->location_data = json_decode($result,true);
        }

    }

    public function getClientIP() {

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}