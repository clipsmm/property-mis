<?php

/**
 * Created by PhpStorm.
 * User: Meshaq
 * Date: 3/3/14
 * Time: 8:40 PM
 */


function asset($asset){
    echo 'res/'.$asset;
}

function nextPage(){
    $url= $_SERVER['HTTP_REFERER'];
    $path = explode('/',$url);
    return end($path);
}
function hasRole($role){
    if ($role != $_SESSION['user_role']){
        header('location:'.nextPage());
    }else{

    }
}
function form_login(){
    return include 'gui/user_login_form.php';
}
function form_newContact(){
    return include $_SERVER['DOCUMENT_ROOT'].'/remis/gui/contact_new_form.html';
}
function form_reg(){
    return include $_SERVER['DOCUMENT_ROOT'].'/remis/gui/user_registration_form.php';
}

function toolbar(){
    return include $_SERVER['DOCUMENT_ROOT'].'/remis/gui/toolbar.php';
}

function form_forgot(){
    return include $_SERVER['DOCUMENT_ROOT'].'/remis/gui/user_forgot_password_form.php';
}

function form($form){
    return '/gui/'.$form.'.php';
}
function copyright(){
    echo "
    <div class=\"copyright\">
    2014 &copy; REMIS
    </div>
    ";
}

function logo(){
    $img = asset('met/img/logo.png');
    echo '
    <div class="logo">
    <img src="$img" alt="The remis" />
    </div>
    ';
}

function home(){
    header('location:'.$_SERVER['DOCUMENT_ROOT'].'/remis/');
}


function today($part){
    $date = date('l-dS-F-Y');
    $myDay = explode('-',$date);
    return $myDay[$part];

}

function parse_path() {
    $path = array();
    if (isset($_SERVER['REQUEST_URI'])) {
        $request_path = explode('?', $_SERVER['REQUEST_URI']);

        $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
        $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
        $path['call'] = utf8_decode($path['call_utf8']);
        if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
            $path['call'] = '';
        }
        $path['call_parts'] = explode('/', $path['call']);

        $path['query_utf8'] = urldecode($request_path[1]);
        $path['query'] = utf8_decode(urldecode($request_path[1]));
        $vars = explode('&', $path['query']);
        foreach ($vars as $var) {
            $t = explode('=', $var);
            $path['query_vars'][$t[0]] = $t[1];
        }
    }
    return $path;
}

function YesNo($var){
    if($var == true){
        return 'YES';
    }

    return 'NO';
}