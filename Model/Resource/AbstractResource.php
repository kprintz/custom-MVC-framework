<?php


namespace Model\Resource;


abstract class AbstractResource extends \DB\Core\DbConnect
{
    protected string $TABLE_NAME;
    protected string $COL_IP;
    protected string $COL_DATE;
    protected string $COL_CALCULATION;

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
        $sql = 'UPDATE ' . $this->TABLE_NAME . ' SET ' . $assocData['columnName'] . ' = \'' . $assocData['newValue'] . '\'  WHERE ' . $assocData['columnName'] . ' = \'' . $assocData['currentValue'] . '\'';

        return $this->executeSql($sql, array_values($assocData));
    }

    /**
     * @param array $assocData
     * @return bool|\PDOStatement
     */
    public function delete(array $assocData)
    {
        $sql = 'DELETE FROM ' . $this->TABLE_NAME . ' WHERE ' . $assocData['columnName'] . ' = \'' . $assocData['calculation'] . '\'';

        return $this->executeSql($sql, array_values($assocData));
    }

    /**
     * @param array $assocData
     * @return bool|\PDOStatement
     */
    public function filter(array $assocData)
    {
        $sql = 'SELECT * FROM ' . $this->TABLE_NAME . ' WHERE ' . $assocData['columnName'] . ' = \'' . $assocData['calculation'] . '\'';

        return $this->executeSql($sql, array_values($assocData));
    }

    /**
     * @param array $assocData
     * @return bool|\PDOStatement
     */
    public function getAllData()
    {
        $sql = 'SELECT * FROM ' . $this->TABLE_NAME;

        return $this->executeSql($sql);
    }
}
