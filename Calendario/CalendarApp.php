<?php
include_once 'connect.php';
include_once 'Calendar.php';

$db = new DBConnector();

//el codigo va a mostrar el elemento segun los solicitado por la url

//muestra un input con la lista de materias
if (isset($_GET['materiaInput'])) {
	$sql = "SELECT * FROM MATERIAS";
	$result = $db->conn->query($sql);

	echo 'Materia:</label><select class="w3-select" id="materiaInput" onchange="CalendarChange()">';
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<option value="'. $row["id"] .'" selected>' . $row["nombre"] . '</option>';
		}
  	}
	echo '</select>';
}

//muestra el calendario
if (isset($_GET['calendar'])) {
	$dateSelected = $_GET['dateSelected'];
	$materiaSelected = $_GET['materiaSelected'];

	$sql = "SELECT id, fecha_ini, fecha_fin FROM CURSADAS WHERE id_materia = " . $materiaSelected . " AND MONTH('" . $dateSelected . "') BETWEEN MONTH(fecha_ini) AND MONTH(fecha_fin);";

	$result = $db->conn->query($sql);

	//crea el calendario
	$calendar = new Calendar($dateSelected);
	//carga la cursada encontrada, si hay
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$calendar->SetFlag($row["fecha_ini"], $row["fecha_fin"]);
	}

	//lo muestra
	$calendar->DrawCalendar();
}

$db->Close();

?>