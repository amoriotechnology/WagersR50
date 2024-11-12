<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('display')) {

    function display($text = null) {
        $ci = & get_instance();
        $ci->load->database();
        $table = 'language';
        $phrase = 'phrase';
        $setting_table = 'web_setting';
        $default_lang = 'english';

        //set language  
        $data = $ci->db->get($setting_table)->row();
        if (!empty($data->language)) {
            $language = $data->language;
        } else {
            $language = $default_lang;
        }

        if (!empty($text)) {

            if ($ci->db->table_exists($table)) {

                if ($ci->db->field_exists($phrase, $table)) {

                    if ($ci->db->field_exists($language, $table)) {

                        $row = $ci->db->select($language)
                                ->from($table)
                                ->where($phrase, $text)
                                ->get()
                                ->row();

                        if (!empty($row->$language)) {
                            return html_escape($row->$language);
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
if (!function_exists('encrypt')) {
    function encrypt($data, $key) {
        $method = 'AES-256-CBC';
        $key = substr(hash('sha256', $key, true), 0, 32);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
        $encrypted = openssl_encrypt($data, $method, $key, 0, $iv);
        return $iv . $encrypted;
    }
}
if (!function_exists('decrypt')) {
function decrypt($data, $key) {
    $method = 'AES-256-CBC';
    $key = substr(hash('sha256', $key, true), 0, 32);
    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);
    return openssl_decrypt($encrypted, $method, $key, 0, $iv);
}
}
if (!function_exists('decodeBase64UrlParameter')) {
    function decodeBase64UrlParameter($urlParam) {
        $text = hex2bin($urlParam);
        return decrypt($text,COMPANY_ENCRYPT_KEY);
    }
}
if (!function_exists('encodeBase64UrlParameter')) {
    function encodeBase64UrlParameter($urlParam) {
        $encres = encrypt($urlParam, COMPANY_ENCRYPT_KEY);
        return bin2hex($encres);
    }
}
if (!function_exists('alpha_space')) {
    function alpha_space($str) {
        return (bool) preg_match('/^[a-zA-Z ]+$/', $str);
    }
}

// Client Ip Address
if(!function_exists('getClientIp')){
    function getClientIp() {
        $ip = '';
        if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}


// Log Common Insert Function
if (!function_exists('logEntry')) {
    function logEntry($user_id, $admin_id, $field_id=null, $hint=null, $username, $user_actions, $module, $details, $status, $c_date) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->load->library('user_agent');
        
        $user_ipaddress = getClientIp();

        date_default_timezone_set('Asia/Kolkata');
        $current_time = new DateTime();
        $formatted_time = $current_time->format('H:i:s');
        $platform = $ci->agent->platform();
        $browser = $ci->agent->browser();
        // $user_location = getUserLocation($user_ipaddress);

        // if ($user_location === 'India') {
        //     date_default_timezone_set('Asia/Kolkata');
        //     $current_time = new DateTime();
        //     $formatted_time = $current_time->format('H:i:s');
        // } elseif ($user_location === 'USA') {
        //     date_default_timezone_set('America/New_York'); 
        //     $current_time = new DateTime();
        //     $formatted_time = $current_time->format('h:i A'); 
        // } else {
        //     date_default_timezone_set('UTC');
        //     $current_time = new DateTime();
        //     $formatted_time = $current_time->format('Y-m-d H:i:s');
        // }

        $data = array(
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'field_id' => $field_id,
            'hint' => $hint,
            'username' => $username,
            'user_ipaddress' => $user_ipaddress,
            'user_platform' => $platform,
            'user_browser' => $browser,
            'user_actions' => $user_actions,
            'module' => $module,
            'details' => $details,
            'status' => $status,
            'c_date' => $c_date,
            'c_time' => $formatted_time, 
        );
        $res = $ci->db->insert('log_entry', $data);
        return true;
    }
}


// Function to fetch geolocation based on IP address
if (!function_exists('getUserLocation')) {
    function getUserLocation($user_ipaddress) 
    {
        $apiKey = '374225fdf6a54fcea7cfdb19e643ded3';
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=$apiKey&ip=$user_ipaddress";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        // var_dump(curl_error($ch));exit;
        if (curl_errno($ch)) {
            curl_close($ch);
            return null;
        }
        curl_close($ch);
        $data = json_decode($response, true);

        if (isset($data['country_name'])) {
            return $data['country_name']; 
        } else {
            return null; 
        }
    }
}

 

