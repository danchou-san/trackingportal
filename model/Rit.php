<?php

class Rit extends db
{
    private $id;
    private $customer;
    private $loading_date;
    private $truck_number;
    private $transport_type;
    private $carrier;
    private $loading_place;
    private $invoice_number;
    private $ecw_number;
    private $offloading_place;
    private $arrival_date;
    private $unloading_date;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getTransportType($transport_type_id)
    {
        $transport_type_sql = "SELECT * FROM transport_types WHERE id = $transport_type_id";

        $transport_type = mysql_fetch_assoc(mysql_query($transport_type_sql));
        return $transport_type['transport_type'];
    }


}



?>
