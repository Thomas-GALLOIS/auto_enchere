<?php



abstract class AbstractView
{

    public function base_url()
    {

        return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . ":8888" . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
    }
}
