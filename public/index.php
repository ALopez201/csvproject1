<!DOCTYPE html>
<html lang="en">



<div class="container">
    <div class="jumErbotron">
        <h1>Anthony's CSV File Web Page</h1>
        <p>This page is intended to disply the resulting table after a CSV file has been read as an array
        then used to generate an html table.</p>
    </div>




<?php

main::start("SalesJan2009.csv");

class main {

    static public function start($filename) {


        $records = csv::getRecords($filename);

        print_r($records);

    }

}




class csv {
    /**
     * @param $filename
     * @return array
     */
    static public function getRecords($filename) {

        $file = fopen($filename, "r");

        while(! feof($file))
        {

            $record = fgetcsv($file);

            $records[] = $record;

        }

        fclose($file);
        return $records;

    }

}

class record{}

class recordfactory {

    public static function create(Array $array = null) {

        $record = new record();

        return $record;

    }
}