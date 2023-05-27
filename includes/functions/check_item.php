<?php

    function get_count_item($select, $from, $type, $value){
        global $connect;

        $stmt = $connect->prepare("SELECT $select FROM $from WHERE $select = ?");
        $stmt->bind_param($type, $value);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = $result->num_rows;

        return $count;
    }

?>