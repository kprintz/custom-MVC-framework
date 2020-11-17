<?php


namespace Model;


class CalculationsData
{
    public string $ip;
    public string $date;
    private array $data = [];

    function setIP()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    function setDate()
    {
        $this->date = date('Y-m-d H:i:s');
    }

    function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    function getIP()
    {
        return $this->ip;
    }

    function getDate()
    {
        return $this->date;
    }

    function getColumn()
    {
        return $this->data['columnName'];
    }

    function getCalculation()
    {
        return $this->data['calculation'];
    }

    function getCurrentValue()
    {
        return $this->data['currentValue'];
    }

    function getNewValue()
    {
        return $this->data['newValue'];
    }
}