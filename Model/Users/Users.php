<?php

namespace Model\Users;

use Model\AbstractModel;
use Model\Users\UsersResource;

class Users extends AbstractModel
{
    private int $id;
    private string $first;
    private string $last;
    private string $dob;
    private string $deleted;

    /** @var array */
    private array $row;

    public function addRow($row)
    {
        $this->row = $row;
        return $this;
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

    public function setFirst($first)
    {
        $this->first = $first;
        return $this;
    }

    public function getFirst()
    {
        return $this->first;
    }

    public function setLast($last)
    {
        $this->last = $last;
        return $this;
    }

    public function getLast()
    {
        return $this->last;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    public function getDob()
    {
        return $this->dob;
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
        $usersResource = new UsersResource();

        $resourceRow = $usersResource->getRow($this->id);

//        $modelRow = [];
//        foreach ($resourceRow->getColumnNames() as $key => $value) {
//            $modelRow[] = $key . " = '{$value}'";
//        }
        for ($i = 0; $i < count($resourceRow->getColumnNames()); $i++) {
            $modelRow[$i] = array_keys($resourceRow->getColumnNames()[$i]);
        }

//        $modelRow = [
//            $usersResource->COL_ID => $this->getId(),
//            $usersResource->COL_FN => $this->getFirst(),
//            $usersResource->COL_LN => $this->getLast(),
//            $usersResource->COL_DOB => $this->getDob(),
//            $usersResource->COL_DELETED => $this->getDeleted()
//        ];

        if (is_array($resourceRow) && $resourceRow[$usersResource->COL_ID]) {
            $usersResource->update(array_merge($resourceRow, $modelRow));
            if (!$usersResource->getNumberRowsLastUpdated()) {
                //todo no rows were updated in DB
            }
        }

        if (!$this->id || !$resourceRow) {
            $usersResource->add($modelRow);
            return $this;
        }
        return $this;
    }

    public function delete()
    {
        if (!$this->getId()) {
            return 'no records matching this id';
        }
        $usersResource = new UsersResource();
        $usersResource->delete($this->getId());
    }

    public function load($id)
    {
        //todo go to database and fetch data here
        //duplicated code - make this a separate function?
        $usersResource = new UsersResource();
        $resourceRow = $usersResource->getRow($this->id);
        $modelRow = [
            $usersResource->COL_ID => $this->getId(),
            $usersResource->COL_FN => $this->getFirst(),
            $usersResource->COL_LN => $this->getLast(),
            $usersResource->COL_DOB => $this->getDob(),
            $usersResource->COL_DELETED => $this->getDeleted()
        ];

        //todo set data here
        $updatedRow = array_merge($modelRow, $resourceRow);
        foreach ($updatedRow as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}
