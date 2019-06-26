<?php

main::start();

class main {

    static public function start() {
        $records = csv::getRecords();
        $table = html::generateTable($records);
        system::printPage($table);

    }

}

class csv {}
class html {}
class system {}
