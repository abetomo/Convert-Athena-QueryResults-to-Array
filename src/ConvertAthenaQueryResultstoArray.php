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
    private static function cast(array $metadata, string $value)
    {
        switch ($metadata['Type']) {
            // TODO: Other types
            case 'integer': return (int) $value;
            case 'double': return (double) $value;
        }
        return $value;
    }

    /**
     * convert
     *
     * @param array $resultSet
     * @param bool $isSkipHeader
     * @return array
     */
    public static function convert(array $resultSet, bool $isSkipHeader = false): array
    {
        $offset = $isSkipHeader ? 1 : 0;
        $rows = array_slice($resultSet['Rows'], $offset);
        $metadata = $resultSet['ResultSetMetadata']['ColumnInfo'];

        return array_map(function ($row) use ($metadata) {
            $hash = [];
            foreach ($row['Data'] as $i => $data) {
                $columnInfo = $metadata[$i];
                $hash[$columnInfo['Name']] = self::cast($columnInfo, $data['VarCharValue'] ?? '');
            }
            return $hash;
        }, $rows);
    }
}
