<?php

namespace Model\Calculations;

use Model\AbstractModel;
use Model\Calculations\CalculationsResource;

class Calculations extends AbstractModel
{
    private string $status;
    private int $id;
    private string $ip;
    private string $date;
    private int $calculation;
    private string $deleted;

    /** @var array */
    private array $row;

    public function addRow($row)
    {
        $this->row = $row;
        return $this;
    }

    //todo we can look at this together later (should auto serialize when we are asking this instantiated Class to turn into an array)
    public function __serialize(): array
    {
        return $this->getRow();
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setCalculation($calculation)
    {
        $this->calculation = $calculation;
        return $this;
    }

    public function getCalculation()
    {
        return $this->calculation;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function setData($column, $value)
    {
        $this->{$column} = $value;
        return $this;
    }

    public function getData($key)
    {
        if (array_key_exists($key, $this->row)) {
            return $this->row[$key];
        }
        return '';
    }

    public function save()
    {
        $calcResource = new CalculationsResource();

        $resourceRow = $calcResource->getRow($this->id);
        $modelRow = [
            $calcResource->COL_ID => $this->getId(),
            $calcResource->COL_IP => $this->getIp(),
            $calcResource->COL_DATE => $this->getDate(),
            $calcResource->COL_CALCULATION => $this->getCalculation(),
            $calcResource->COL_DELETED => $this->getDeleted()
        ];

        if (is_array($resourceRow) && $resourceRow[$calcResource->COL_ID]) {
            $calcResource->update(array_merge($resourceRow, $modelRow));
            if (!$calcResource->getNumberRowsLastUpdated()) {
                //todo no rows were updated in DB
            }
        }

        if (!$this->id || !$resourceRow) {
            $calcResource->add($modelRow);
        }
        return $this;
    }

    public function delete()
    {
        if (!$this->getId()) {
            return 'no records matching this id';
        }
        $calcResource = new CalculationsResource();
        $calcResource->delete($this->getId());
    }

    public function load($id)
    {
        //todo go to database and fetch data here
        //duplicated code - make this a separate function?
        $calcResource = new CalculationsResource();
        $resourceRow = $calcResource->getRow($this->id);
        $modelRow = [
            $calcResource->COL_ID => $this->getId(),
            $calcResource->COL_IP => $this->getIp(),
            $calcResource->COL_DATE => $this->getDate(),
            $calcResource->COL_CALCULATION => $this->getCalculation(),
            $calcResource->COL_DELETED => $this->getDeleted()
        ];

        //todo set data here
        $updatedRow = array_merge($modelRow, $resourceRow);
        foreach ($updatedRow as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}
