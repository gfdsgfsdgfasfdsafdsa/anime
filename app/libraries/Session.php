<?php
class Session {
    public static function get($key) {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        return '';
    }

    public static function set($key, $val) {
        if(!is_null($key) && !is_null($val))
            $_SESSION[$key] = $val;
    }

    public static function remove($key){
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    public static function destroy() {
        unset($_SESSION);

        session_destroy();
    }
}