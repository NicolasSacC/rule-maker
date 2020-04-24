<?php 

namespace AsteroidSnowsuit\RuleMaker\Migration;

class MigrationParser {

    /**
     * Retrieves all the lines that create a field in the migration
     * @var string $file Migration file
     * @return array $l Field lines
     */
    static function getFieldLines(string $file) {
        $a = array_map('trim', explode("\n", $file));
        $l = array_filter($a, "self::checkIfLineIsField");
        return $l;
    }

    /**
     * Check if the provided line creates a field in the migration
     * @var string $line Line in the migration
     * @return bool 
     */
    static function checkIfLineIsField($line) {
        return strpos($line, '$table->') === 0;
    }

    /**
     * Take the field line and extract the data to a provided array
     * @var string $line Line that contains the field information
     * @var array $a Array that will contain the extracted data
     * @return array $a Array containing the extracted data
     */
    static function extractData($line, $a) {
        preg_match("\$table->([a-zA-Z_-]+)\('([a-zA-Z_-]+)'\)$", $line, $r);
        if(sizeof($r) !== 0) {
            $a[$r[2]] = $r[1];
            return $a;
        } 
    }
}