<?php namespace Codesleeve\Fixture\Drivers;

abstract class BaseDriver
{
    /**
     * Truncate a table.
     *
     * @param  string $tableName
     * @return void
     */
    public function truncate($tableName = null)
    {
        $tables = ! empty($tableName) ? [$tableName] : $this->tables;
        foreach ($tables as $table) {
            $this->db->query("DELETE FROM $table");
            unset($this->tables[$table]);
        }
    }

    /**
     * Generate an integer hash of a string.
     * We'll use this method to convert a fixture's name into the
     * primary key of it's corresponding database table record.
     *
     * @param  string $value - This should be the name of the fixture.
     * @return integer
     */
    protected function generateKey($value)
    {
        $hash = sha1($value);
        $integerHash = base_convert($hash, 16, 10);

        return (int)substr($integerHash, 0, 8);
    }
}
