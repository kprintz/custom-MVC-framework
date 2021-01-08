<?php

namespace Model;

abstract class AbstractModel
{
    protected string $table;
    protected $resource;
    protected $collectionModel;
    protected int $id = 0;
    protected $deleted;

    public function __construct()
    {
        $collectionName = "\\Model\\$this->table\\$this->table" . 'Collection';
        $resourceName = "\\Model\\$this->table\\$this->table" . 'Resource';
        $this->collectionModel = new $collectionName($this->table);
        $this->resource = new $resourceName($this->table);
    }

    /**
     * Saves model data to resource
     *
     * @return $this|void
     */
    public function save()
    {
        $resourceRow = $this->getResource()->getRow($this->id);

        $modelRow = [];
        foreach ($this->getResource()->getColumnNames() as $columnName) {
            $modelRow[$columnName] = $this->getData($columnName);
        }

        if (is_array($resourceRow) && $resourceRow[$this->getResource()->getIdColumnName()]) {
            $this->getResource()->update(array_merge($resourceRow, $modelRow));
            if (!$this->getResource()->getNumberRowsLastUpdated()) {
                //todo no rows were updated in DB
            }
        }

        if (!$this->id || !$resourceRow) {
            $this->getResource()->add($modelRow);
        }
        return $this;
    }

    public function delete()
    {
        if (!$this->getId()) {
            return 'no records matching this id';
        }
        $this->getResource()->delete($this->getId());
    }

    /**
     * Saves resource row to model row
     *
     * @return $this|void
     */
    public function load($id = null)
    {
        if (!$id) {
            $this->getId();
        } else {
            $this->setId($id);
        }
        $resourceRow = $this->getResource()->getRow($this->getId());

        foreach ($resourceRow as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    public function getCollection()
    {
        return $this->collectionModel;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setData($column, $value)
    {
        $this->{$column} = $value;
        return $this;
    }

    public function getData($key)
    {
        return $this->{$key};
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

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }
}
