<?php
namespace Abetomo\ConvertAthenaQueryResultstoArray;

class ConvertAthenaQueryResultstoArray
{
    /**
     * cast
     *
     * @param array $metadata
     * @param string $value
     * @return mixed
     */
    public static function cast(array $metadata, string $value)
    {
        switch ($metadata['Type']) {
            // TODO: Other types
            case 'integer': return (int) $value;
        }
        return $value;
    }

    /**
     * convert
     *
     * @param array $resultSet
     * @return array
     */
    public static function convert(array $resultSet): array
    {
        $rows = array_slice($resultSet['Rows'], 1);
        $metadata = $resultSet['ResultSetMetadata']['ColumnInfo'];

        return array_map(function ($row) use ($metadata) {
            $hash = [];
            foreach ($row['Data'] as $i => $data) {
                $columnInfo = $metadata[$i];
                $hash[$columnInfo['Name']] = self::cast($columnInfo, $data['VarCharValue']);
            }
            return $hash;
        }, $rows);
    }
}
