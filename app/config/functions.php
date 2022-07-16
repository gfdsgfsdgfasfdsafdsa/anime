<?php
//function urlExistsImg($remoteImageURL) {
//    if(@getimagesize($remoteImageURL)){
//        echo 'true';
//    }else{
//        echo 'false';
//    }
//}
function ago($time)
{
    $time_difference = time() - strtotime($time);

    if( $time_difference < 1 ) { return 'Less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
        30 * 24 * 60 * 60       =>  'month',
        24 * 60 * 60            =>  'day',
        60 * 60                 =>  'hour',
        60                      =>  'minute',
        1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
function hashPassword($password){
    return password_hash($password, PASSWORD_BCRYPT);
}
function isUrlExist($url){
    // Use get_headers() function
    $headers = @get_headers($url);
    $status = false;
    // Use condition to check the existence of URL
    if($headers && strpos( $headers[0], '200')) {
        $status = true;
    }
    return $status;
}
function generateSlug($title) {
    //filter letters and numbers
    $x = preg_replace('/[^\p{L}\p{N} ]+/', '', $title);
    //change spaces with -
    return strtolower(preg_replace('/\s+/', '-',$x));
}
function readableSlug($val){
    return ucwords(str_replace('-', ' ', $val));
}
function formatDate($d){
    if($d == '0000-00-00')
        return '?';

    $date = new DateTime($d);
    return $date->format('M d, Y');
}
function setValue($name){
    $value = '';
    if(Request::post() && isset($_POST[$name]))
        $value = $_POST[$name];
    else if(Request::get() && isset($_GET[$name]))
        $value = $_GET[$name];
    return $value;
}
function setSelectedValue($data, $name){
    if(!isset($name)) return;
    if(Request::post() && isset($_POST[$name])){
        if(!empty($_POST[$name])){
            if(in_array($data, $_POST[$name]))
                return 'selected';
        }else{
            return '';
        }
    }
}
function redirect($redirect, $message = null, $message_type = null)
{
    //Message Type for bootstrap framework
    if ($message != null)
        Session::set('message', $message);
    if ($message_type != null) {
        Session::set('message_type', $message_type);
    }
    if ($redirect != false) {
        header('Location: ' . ROOTURL. $redirect);
    }
    if($redirect == ''){
        header('Location: ' . ROOTURL);
    }
}
function flashMessage($bootstrap_additional_class = '')
{
    $message = Session::get('message');
    $message_type = Session::get('message_type');
    if (!empty($message) && !empty($message_type)) {
        echo '<div class="alert alert-dismissible alert-'.$message_type.' '.$bootstrap_additional_class.'">
                  <button class="close" data-dismiss="alert">&times;</button>'
            . $message .
            '</div>';
    }else if(!empty($message)){
        echo $message;
    }
    Session::remove('message');
    Session::remove('message_type');
}
function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}

function alert($message, $message_type, $bootstrap_additional_class = ''){
    echo '<div class="alert alert-dismissible alert-'.$message_type.' '.$bootstrap_additional_class.'">
                  <button class="close" data-dismiss="alert">&times;</button>'
        . $message .
        '</div>';
}
function htmlEncode($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}