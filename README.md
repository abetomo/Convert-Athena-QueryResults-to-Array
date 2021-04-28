# Convert-Athena-QueryResults-to-Array

[![Latest Stable Version](https://poser.pugx.org/abetomo/convert-athena-query-results-to-array/v/stable)](https://packagist.org/packages/abetomo/convert-athena-query-results-to-array)
[![Test](https://github.com/abetomo/Convert-Athena-QueryResults-to-Array/actions/workflows/workflow.yml/badge.svg)](https://github.com/abetomo/Convert-Athena-QueryResults-to-Array/actions/workflows/workflow.yml)

Convert AWS Athena QueryResults to Array.
Since the response of GetQueryResults is complicated, it converts it to a simple array.

## Installation
```bash
% composer require abetomo/convert-athena-query-results-to-array
```

## Usage
Convert the response of GetQueryResults into an array.

```php
<?php
// ... startQueryExecution, etc.

$getQueryResultsResponse = $athenaClient->getQueryResults([
    'QueryExecutionId' => $queryExecutionId
]);
use Abetomo\ConvertAthenaQueryResultstoArray\ConvertAthenaQueryResultstoArray;
print "/// Original value\n";
print_r($getQueryResultsResponse->get('ResultSet'));
print "\n/// Convert to array \n";
print_r(ConvertAthenaQueryResultstoArray::convert($getQueryResultsResponse->get('ResultSet')));
```

## Example of results
### Convert to array
```
Array
(
    [0] => Array
        (
            [account_id] => id1
            [count] => 49
        )

    [1] => Array
        (
            [account_id] => id2
            [count] => 68
        )

)
```

### Original value
```
Array
(
    [Rows] => Array
        (
            [0] => Array
                (
                    [Data] => Array
                        (
                            [0] => Array
                                (
                                    [VarCharValue] => account_id
                                )

                            [1] => Array
                                (
                                    [VarCharValue] => count
                                )

                        )

                )

            [1] => Array
                (
                    [Data] => Array
                        (
                            [0] => Array
                                (
                                    [VarCharValue] => id1
                                )

                            [1] => Array
                                (
                                    [VarCharValue] => 49
                                )

                        )

                )

            [2] => Array
                (
                    [Data] => Array
                        (
                            [0] => Array
                                (
                                    [VarCharValue] => id2
                                )

                            [1] => Array
                                (
                                    [VarCharValue] => 68
                                )

                        )

                )

        )

    [ResultSetMetadata] => Array
        (
            [ColumnInfo] => Array
                (
                    [0] => Array
                        (
                            [CatalogName] => hive
                            [SchemaName] =>
                            [TableName] =>
                            [Name] => account_id
                            [Label] => account_id
                            [Type] => varchar
                            [Precision] => 2147483647
                            [Scale] => 0
                            [Nullable] => UNKNOWN
                            [CaseSensitive] => 1
                        )

                    [1] => Array
                        (
                            [CatalogName] => hive
                            [SchemaName] =>
                            [TableName] =>
                            [Name] => count
                            [Label] => count
                            [Type] => integer
                            [Precision] => 10
                            [Scale] => 0
                            [Nullable] => UNKNOWN
                            [CaseSensitive] =>
                        )

                )

        )

)
```
