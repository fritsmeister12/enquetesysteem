<?php

namespace src\Model;

class HomeData
{
    function __construct($con)
    {
        $this->con = $con;
    }

    function fetchAllAdmin($sql)
    {
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
