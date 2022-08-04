<?php

function aesencryptstring($plain)
{
    $CI = &get_instance();
    $CI->load->library("php_aes_cipher");
    $chiper = $CI->php_aes_cipher->encrypt($CI->config->item('default_keyaes'), $CI->config->item('default_ivaes'), $plain);
    $CI->load->helper('safebase64');
    $chiper = safe_b64encode($chiper);
    return $chiper;
}

function aesdecryptstring($chiper)
{
    $CI = &get_instance();
    $CI->load->helper('safebase64');
    $chiper = base64_decode($chiper);
    $CI->load->library("php_aes_cipher");
    $plain = $CI->php_aes_cipher->decrypt($CI->config->item('default_keyaes'), $chiper);
    return $plain;
}
