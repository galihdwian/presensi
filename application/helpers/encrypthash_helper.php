<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Encrypt_hash
 * @author IMAM SYAIFULLOH
 */
if (!function_exists('ehash_make')) {

    function ehash_make($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    }

}

if (!function_exists('ehash_check')) {

    function ehash_check($password, $hash) {
        if (password_verify($password, $hash)) {
            return true;
        }
    }

}
?>
