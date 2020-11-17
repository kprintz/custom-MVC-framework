<?php


namespace Model;


class Calculations
{
    private string $status;

    /** @var array */
    private array $rows = [];

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setRows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * @param $row array
     * @return $this
     */
    public function addRow($row)
    {
        $this->rows[] = $row;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRows()
    {
        return $this->rows;
    }
}
