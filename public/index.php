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
        $table = html::generateTable($records);





    }

}

class html{

    public static function generateTable($records) {

        foreach ($records as $record) {

            $array = $record->returnArray();
            print_r($array);

        }

    }
}




class csv {


    static public function getRecords($filename) {



        $file = fopen($filename, "r");
        $fieldNames = array();

        $count = 0;

        while(! feof($file))
        {

            $record = fgetcsv($file);
            if($count == 0) {
                $fieldNames = $record;
            } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;

            $records[] = recordFactory::create($record);

        }

        fclose($file);
        return $records;

    }

}


class record{

    public function __construct(Array $fieldNames = null, $values = null)
    {


        $record = array_combine($fieldNames, $values);

        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }




    }

    public function createRow() {
        print_r($this);
    }


    public function createProperty($name = 'Name', $value = 'carolina') {

        $this->{$name} = $value;

    }
}

class recordFactory {

    public static function create(Array $fieldNames = null, Array $values = null) {
        print_r($fieldNames);
        print_r($record);


        $record = new record($fieldNames, $values);

        return $record;



    }
}