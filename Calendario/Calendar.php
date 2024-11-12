<?php
class Calendar{
	//ATRIBUTOS
	//datos para la creacion del mes que va a mostrar
	private $firstDay;
	private $lastDay;
	private $numDays;

	//bandera para marcar el calendario
	private $flagList;	
	//bandera 0 nada 1 pinta

	//estilo
	//color que usa para pintar en los dias marcados
	private $flagColor = 'red';

	//CONSTRUCTOR
	function __construct($date){
		$this->firstDay = date('Y-m-01', strtotime($date));
		$this->lastDay = date('Y-m-t', strtotime($date));
		$this->numDays = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($date)), date('y', strtotime($date)));

		$this->flagList = array();
		for ($i=1; $i <= $this->numDays; $i++) $this->flagList[$i] = 0;
	}

	//FUNCIONES PRIVADAS
	private function flagToColor($flag){		
		$tempColor = 'style="color:' . $flagColor . ';"';
		//marca con color
		switch ($flag) {
			case 0:
				return '<b ' . $tempColor . '>0</b>'; //quitar el 0 porque es vacio
				break;
			case 1:
				return '<b ' . $tempColor . '>1</b>';
				break;

			default:
				return '<b>Si ves esto, avisá a alguien 😂</b>';
				break;
		}
	}	

	//FUNCIONES PÚBLICAS
	public function SetFlag($dateStart, $dateEnd){
		//se encarga de marcar los dias y pone una bandera

		//indices de inicio y fin
		$dayStart = intval(substr($dateStart, -2));
		$dayEnd = intval(substr($dateEnd, -2));

		//primero comprueba si el dia de inicio no es previo al mes actual para marcar que empiece de 0
		if(date('Y-m-d', strtotime($dateStart)) < $this->firstDay) $dayStart = 0;
			
		//Comprueba si la fecha fin esta dentro del mes
		if (date('Y-m-d', strtotime($dateEnd)) <= $this->lastDay) {
			//recorre marcando dias
			for ($i=$dayStart; $i <= $dayEnd; $i++) $this->flagList[$i] = 1;
		}else{
			//sino solo recorre hasta el final marcando solo dias ocupados
			$dayEnd = $this->numDays;
			for ($i=$dayStart; $i <= $dayEnd; $i++) $this->flagList[$i] = 1;
		}
	}

	public function DrawCalendar(){
		//dibuja el calendario
		echo '<table>';
		echo '<tr><th>Domingo</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th></tr>';

		$currentDay = 1;
		echo '<tr>';

		//para la primera semana del mes debe hacer un chequeo extra ya que no siempre el dia 1 es el primer dia de la semana
		$firstDayOfMonth = date('w', mktime(0, 0, 0, date('m', strtotime($this->firstDay)), 1, date('y', strtotime($this->firstDay))));
		for ($i=0; $i < 7; $i++) { 			
			if ($i < $firstDayOfMonth) {
				echo '<td></td>';
			}else{
				echo '<td> ' . '<h4>' . $currentDay . '</h4>' . '<h4>' . $this->flagToColor($this->flagList[$currentDay]) . '</h4>' . ' </td>';
				$currentDay++;
			}
		}
		echo '</tr>';

		//continua con el resto del mes
		while ($currentDay <= $this->numDays) {
			echo '<tr>';
			for ($i=0; $i < 7; $i++) { 
				if ($currentDay > $this->numDays) {
					echo '<td></td>';
				}else{
					echo '<td> ' . '<h4>' . $currentDay . '</h4>' . '<h4>' . $this->flagToColor($this->flagList[$currentDay]) . '</h4>' . ' </td>';
					$currentDay++;
				}
			}
			echo '</tr>';
		}

		echo '</table>';
	}
}
?>