CREATE TABLE `marker_sem_colab`.`MATERIAS` (`id` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

CREATE TABLE `marker_sem_colab`.`CURSADAS` (`id` INT NOT NULL AUTO_INCREMENT , `id_materia` INT NOT NULL , `fecha_ini` DATE NOT NULL , `fecha_fin` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

INSERT INTO `MATERIAS` (`id`, `nombre`) VALUES ('1', 'Sistemas Colaborativos'), ('2', 'Programación'), ('3', 'Auditoria de sistemas') 

INSERT INTO `CURSADAS` (`id`, `id_materia`, `fecha_ini`, `fecha_fin`) VALUES ('1', '1', '2024-08-05', '2024-12-07'), ('2', '2', '2024-08-05', '2024-12-07'), ('3', '3', '2024-10-07', '2024-12-07') 
