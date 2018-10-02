<?php
include "../../model/db.php";
$db = new db();

if( isset($_GET['id']) )
{
    $id = $_GET['id'];
    $toevoegen = "INSERT INTO archief (`id`, `customer_id`, `loading_date`, `truck_number`, `transport_type_id`, `carrier_id`, `loading_place`, `invoice_number`, `ecw_number`, `offloading_place`, `arrival_date`, `unloading_date`)
    SELECT `id`, `customer_id`, `loading_date`, `truck_number`, `transport_type_id`, `carrier_id`, `loading_place`, `invoice_number`, `ecw_number`, `offloading_place`, `arrival_date`, `unloading_date`
    FROM ritten
    WHERE id = $id";

    $verwijderen = "DELETE FROM ritten WHERE id='$id'";

    $stmt_toevoegen = $db->connect()->query($toevoegen);
    $stmt_verwijderen = $db->connect()->query($verwijderen);
    echo "<meta http-equiv='refresh' content='0;url=beheertransport.php'>";
}
else
{
    header("Location: ../../error.php");
}
?>
