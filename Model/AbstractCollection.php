<?php

namespace Model;

abstract class AbstractCollection
{
    protected $items = [];

    protected string $table;
    protected string $modelClass;
    protected $resource;

    public function __construct($table)
    {
        $this->table = $table;
        $this->modelClass = "\\Model\\$this->table\\$this->table";
        $resourceName = "\\Model\\$this->table\\$this->table" . 'CollectionResource';
        $this->resource = new $resourceName($this->table);
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function addItem($model)
    {
        $this->items[] = $model;
        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addFilter($filterBy)
    {
        $rows = $this->resource->filter($filterBy);
        foreach ($rows as $row) {
            $calc = new $this->modelClass();
            foreach ($row as $columnName => $value) {
                $calc->setData($columnName, $value);
            }
            $this->addItem($calc);
        }
        return $this;
    }
}
