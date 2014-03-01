

-- -----------------------------------------------------
-- Table `Materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Materia` (
  `id` INT NOT NULL,
  `nombreMateria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
;


-- -----------------------------------------------------
-- Table `Carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Carrera` (
  `codigoCarrera` INT NOT NULL,
  `nombreCarrera` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigoCarrera`))
;


-- -----------------------------------------------------
-- Table `Plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Plan` (
  `anioPlan` YEAR NOT NULL,
  `Carrera_codigoCarrera` INT NOT NULL,
  `codigoPlan` INT NOT NULL,

  PRIMARY KEY (`codigoPlan`),
  CONSTRAINT `fk_Plan_Carrera`
    FOREIGN KEY (`Carrera_codigoCarrera`)
    REFERENCES `Carrera` (`codigoCarrera`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `Materia_has_Plan`
-- -----------------------------------------------------
CREATE TABLE "Materia_has_Plan" (
"Materia_id" INT PRIMARY KEY  NOT NULL  DEFAULT (null) references materia (id) on delete cascade,
"Plan_id" INT NOT NULL  DEFAULT (null) references plan (id) on delete cascade,
"anio" INT,
"cuatrimestre" INT)

-- -----------------------------------------------------
-- Table `Tipo_Examen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Tipo_Examen` (
  `nombreTipoExamen` VARCHAR(45) NOT NULL,
  `Materia_codigoMateria` INT NOT NULL,
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
 

  CONSTRAINT `fk_TipoExamen_Materia1`
    FOREIGN KEY (`Materia_codigoMateria`)
    REFERENCES `Materia` (`codigoMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `Examen`
-- -----------------------------------------------------
-- SI solo se permite un examen por dia por materia el codigo examen es la concatenacion de fecha y materia_codigoExamen

CREATE TABLE "Examen" (
"id" INTEGER PRIMARY KEY  NOT NULL  DEFAULT (null) ,
"fechaExamen" DATE NOT NULL ,
"tipoexamen_id" INT NOT NULL  DEFAULT (null) references Tipo_Examen (id) ON DELETE CASCADE,
"materia_id" INT NOT NULL  DEFAULT (null) references Materia (id) ON DELETE CASCADE,
"descripcionExamen" VARCHAR(45))
;

CREATE TABLE `users` (
  `username` varchar(11) NOT NULL,
   `password` varchar(20) NOT NULL,
   `role` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)

) 