<?php
namespace Abetomo\ConvertAthenaQueryResultstoArray;

class ConvertAthenaQueryResultstoArray
{
    public static function cast(array $metadata, string $value)
    {
        switch ($metadata['Type']) {
            // TODO: Other types
            case 'integer': return (int) $value;
        }
        return $value;
    }

    public static function convert(array $resultSet)
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
