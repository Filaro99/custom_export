
<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

// BAZA DANYCH (DOSTĘP,ZAPYTANIE,ZNAJDOWANIE)
global $db; // UZYSKIWANIE DOSTĘP DO BAZY DANYCH SUITECRM
$results = $db->query( "SELECT accounts.* FROM accounts" , true); // ROBI ZAPYTANIE DO BAZY DANYCH
$row = $db->fetchByAssoc($results);  // OTRZYMANIE WYNIKU,ODPOWIEDZI OD BAZY DANYCH


echo $row['id'];
//$str = "";
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        $str .= "id: " . $row["name"];
//    }
//} else {
//    echo "0 results";
//}
//echo $str;
?>
