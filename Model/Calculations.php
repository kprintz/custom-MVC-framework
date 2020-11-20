<?php


namespace Model;


class Calculations
{
    private string $status;

    //todo we can look at this together later (should auto serialize when we are asking this instantiated Class to turn into an array)
    public function __serialize(): array
    {
        return $this->getRow();
    }

    /** @var array */
    private array $row;

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param $row array
     * @return $this
     */
    public function addRow($row)
    {
        $this->row = $row;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function getData($key)
    {
        if (array_key_exists($key, $this->row)) {
            return $this->row[$key];
        }
        return '';
    }
}
