<?php


namespace Model;


class Request
{
    private string $ip;
    private string $date;
    private string $uri;
    private array $postData = [];

    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->date = date('Y-m-d');
        $this->setPostData($_POST);
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setPostData($postData)
    {
        $this->postData = $postData;
        return $this;
    }

    public function getIP()
    {
        return $this->ip;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPostData($key)
    {
        if (array_key_exists($key, $this->postData)) {
            return $this->postData[$key];
        }
        return '';
    }
}
