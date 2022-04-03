<?php

require 'graphicModel.php';

$MG = new Graphic_Model();
query = $MG -> getData();
echo json_encode($query);

?>