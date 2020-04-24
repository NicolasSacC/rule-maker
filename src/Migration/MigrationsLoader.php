<?php 

namespace AsteroidSnowsuit\RuleMaker\Migration;

class MigrationsLoader {

    protected $migrationsDir;

    public function __construct(string $migrationsDir = '\database\migrations\\') {
        $this->migrationsDir = \base_path() . $migrationsDir;
    }

    public function findFilesContaining(string $model) {
        $directories = array_filter(scandir($this->migrationsDir), function ($v) use ($model) {
            return strpos($v, $model) !== False;
        });
        return array_values($directories);
    }

    public function load(string $file) {
        return file_get_contents($this->migrationsDir . $file);
    }

}