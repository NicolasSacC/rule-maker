<?php

namespace AsteroidSnowsuit\RuleMaker\Utilities;

class Format {

    /**
     * Takes fields and returns an array that can be display by the Command class
     * @var array $fields Fields for the rule
     * @return array $table Array suitable for display
     */
    static function fieldsToTable(array $fields) {
        $table = [];
        foreach($fields as $k => $v) {
            array_push($table, [$k, $v]);
        }
        return $table;
    }
}