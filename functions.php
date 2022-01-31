<?php

function add($sql)
{
}

function get($conn, $table, $select = null, $condition = null)
{
    if ($select == null) {
        if ($condition == null) {
            $sql = "SELECT * FROM `$table`";
            return mysqli_query($conn, $sql);
        } else {
            $sql = "SELECT * FROM `$table` WHERE " . $condition;
            return mysqli_query($conn, $sql);
        }
    } else {
        $sql = "SELECT `$select` FROM `$table` WHERE " . $condition;
        return mysqli_query($conn, $sql);
    }
}

function update($conn, $table, $set, $condition)
{
    $sql = "UPDATE `$table` SET " . $set . " WHERE " . $condition;
    return mysqli_query($conn, $sql);
}

function delete()
{
}

function countRow($conn, $table, $condition = null)
{
    if ($condition == null)
        $sql = "SELECT * FROM `$table`";
    else
        $sql = "SELECT * FROM `$table` WHERE " . $condition;

    return mysqli_num_rows(mysqli_query($conn, $sql));
}
