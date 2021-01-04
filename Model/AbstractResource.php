<?php

namespace Model;

use Model\ResourceInterface;

abstract class AbstractResource extends \DB\Core\DbConnect implements ResourceInterface
{
    protected string $TABLE_NAME;
    public string $COLUMN_NAME = 'columnName';
    public string $FILTER_VALUE = 'filterValue';
    public string $NEW_VALUE = 'newValue';

    public string $COL_ID = 'ID';
    public string $COL_DELETED = 'deleted';

    protected $rowsUpdated;

    /**
     * @param $sql
     * @param array $values
     * @return bool|\PDOStatement
     */
    public function executeSql($sql, array $values = null)
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($values);
        $this->rowsUpdated = $stmt->rowCount();
        return $stmt;
    }

    public function getNumberRowsLastUpdated()
    {
        return $this->rowsUpdated;
    }

    /**
     * @param array $assocData
     * @return bool|\PDOStatement
     */
    public function add(array $assocData)
    {
        $valuesString = str_repeat('?,', count($assocData));
        $valuesString = trim($valuesString, ',');
        $sql = 'INSERT INTO ' . $this->TABLE_NAME . ' (' . implode(',', array_keys($assocData)) . ') VALUES (' . $valuesString . ')';
        return $this->executeSql($sql, array_values($assocData));
    }

    /**
     * @param array $assocData
     * @return bool|\PDOStatement
     */
    public function update(array $assocData)
    {
        $sqlSetData = [];
        foreach ($assocData as $key => $value) {
            $sqlSetData[] = $key . " = '{$value}'";
        }
        $sql = 'UPDATE ' . $this->TABLE_NAME . ' SET ' .
            implode(',', $sqlSetData)
            . ' WHERE ' .
            $this->COL_ID . ' = \'' . $assocData[$this->COL_ID] . '\'';

        return $this->executeSql($sql, array_values($assocData));
    }

    /**
     * @param $id
     * @return bool|\PDOStatement
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM ' . $this->TABLE_NAME . ' WHERE ' . $this->COL_ID . ' = \'' .
            $id . '\'';

        return $this->executeSql($sql, [$id]);
    }

    /**
     * @param array $assocData
     * @return bool|\PDOStatement
     */
    public function filter(array $assocData)
    {
        $sql = 'SELECT * FROM ' . $this->TABLE_NAME . ' WHERE ' . $assocData[$this->COLUMN_NAME] . ' = \'' .
            $assocData[$this->FILTER_VALUE] . '\'';

        return $this->executeSql($sql, array_values($assocData));
    }

    public function getRow($id)
    {
        $sql = 'SELECT * FROM ' . $this->TABLE_NAME . ' WHERE ID = \'' . $id . '\'';

        $statement = $this->executeSql($sql, [$id]);
        return $statement->fetch();
    }

    /**
     * @return bool|\PDOStatement
     */
    public function getAllData()
    {
        $sql = 'SELECT * FROM ' . $this->TABLE_NAME;

        return $this->executeSql($sql);
    }
}
