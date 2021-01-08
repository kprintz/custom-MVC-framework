<?php


namespace Model;


abstract class AbstractCollectionResource extends \DB\Core\DbConnect
{
    protected string $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @param array $assocData
     * @return array
     */
    public function filter(array $assocData)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ';
        foreach ($assocData as $columnName => $value) {
            $sql .= $columnName . ' = \'' . $value . '\'';
        }

        $stmt = $this->executeSql($sql, array_values($assocData));
        return $stmt->fetchAll();
    }

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
}
