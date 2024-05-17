<?php

class ServiceModel
{
    public function getServices()
    {
        $data = array();
        $db = Database::getInstance();

        $query = "SELECT * FROM services";
        $result = $db->read($query, $data);

        if ($result && is_array($result)) {
            return $result;
        }

        return array();
    }
}
