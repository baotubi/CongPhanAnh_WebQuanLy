<?php
    function redirectUrl($url) {
        header('Location: '.$url);
        die();
    }