<!DOCTYPE html>
<html lang="en">



<div class="container">
    <div class="jumErbotron">
        <h1>Anthony's CSV File Web Page</h1>
        <p>This page is intended to disply the resulting table after a CSV file has been read as an array
        then used to generate an html table.</p>
    </div>




<?php

main::start("example.csv");

class main {

    static public function start($filename) {




        $records = csv::getRecords($filename);
        html::generateTable($records);





    }

}

class html{

    public static function generateTable($records) {
        $count = 0;

        echo

        $row = 1;
        if (($handle = fopen("example.csv", "r")) !== FALSE) {

            echo '<table border="1">';

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                if ($row == 1) {
                    echo '<thead><tr>';
                } else {
                    echo '<tr>';
                }

                for ($c = 0; $c < $num; $c++) {
                    //echo $data[$c] . "<br />\n";
                    if (empty($data[$c])) {
                        $value = "&nbsp;";
                    } else {
                        $value = $data[$c];
                    }
                    if ($row == 1) {
                        echo '<th>' . $value . '</th>';
                    } else {
                        echo '<td>' . $value . '</td>';
                    }
                }

                if ($row == 1) {
                    echo '</tr></thead><tbody>';
                } else {
                    echo '</tr>';
                }
                $row++;
            }

            echo '</tbody></table>';
            fclose($handle);
        };

        foreach ($records as $record) {
            if($count == 0) {

                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);



            } else {
                $array = $record->returnArray();
                $values = array_values($array);





            }$count++;

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

    public function returnArray() {
        $array = (array) $this;
    }


    public function createProperty($name, $value) {

        $this->{$name} = $value;

    }
}

class recordFactory {

    public static function create(Array $fieldNames = null, Array $values = null) {


        $record = new record($fieldNames, $values);







    }
}


