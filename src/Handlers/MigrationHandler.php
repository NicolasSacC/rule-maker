<?php 

namespace AsteroidSnowsuit\RuleMaker\Handlers;

use AsteroidSnowsuit\RuleMaker\Migration\MigrationsLoader;
use AsteroidSnowsuit\RuleMaker\Migration\MigrationParser;
use Illuminate\Console\Command;

class MigrationHandler {
    static function handle(Command $cmd) {
        if($cmd->confirm('Are the rules based on a migration/model ?'))
        {
            $files = [];
            $fileIndex = -1;
            $ml = new MigrationsLoader();
            while(True) {
                $model = $cmd->ask('What model do you want to build your rules on ?');
                $files = $ml->findFilesContaining($model);
                if($files !== []) {
                    break;
                }  else {
                    $cmd->error('There is no file corresponding');
                    if(!$cmd->confirm('Do you want to retry ?')) {
                        break;
                    }
                }
            }
            for($i = 0; $i < sizeof($files); $i++) {
                $cmd->line("[$i] $files[$i]");
            }
            while(!in_array($fileIndex, range(0, sizeof($files) - 1))) {
                $fileIndex = $cmd->ask('Select a file with the corresponding number');
            }
            $data = MigrationParser::extractAllData($ml->load($files[$fileIndex]));
            return $data;
        }
        return [];
    }
}