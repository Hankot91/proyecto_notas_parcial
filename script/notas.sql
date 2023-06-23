CREATE DATABASE notas;

CREATE TABLE estudiantes(
    cod_est INTEGER CHECK (cod_est >= 0) PRIMARY KEY NOT NULL,
    nomb_est VARCHAR(50) NOT NULL
)

CREATE TABLE inscripciones(
    cod_inscripcion INTEGER CHECK (cod_inscripcion >= 0) PRIMARY KEY NOT NULL,
    periodo INTEGER NOT NULL CHECK (periodo IN (1,  2)),
    anho INTEGER CHECK (anho <= date_part('year', current_date)),
    cod_cur INTEGER,
    cod_est INTEGER
)

CREATE TABLE cursos(
    cod_cur  INTEGER CHECK (cod_cur >= 0) PRIMARY KEY NOT NULL,
    nomb_cur VARCHAR(30)
)

CREATE TABLE notas(
    nota VARCHAR(30) PRIMARY KEY NOT NULL,
    descrip_nota VARCHAR(50) NOT NULL,
    porcentaje DECIMAL(5,2) CHECK(porcentaje >= 0 AND porcentaje <= 100),
    posicion INTEGER CHECK(posicion >= 0),
    cod_cur INTEGER
)

CREATE TABLE calificaciones(
    cod_cal  INTEGER CHECK (cod_cal >= 0) PRIMARY KEY NOT NULL,
    valor INTEGER CHECK(valor >= 0 AND valor <= 5),
    fecha DATE CHECK(fecha <= CURRENT_DATE),
    cod_inscripcion INTEGER,
    nota VARCHAR(30)
)

--Agragando los constrain y restricciones  a inscripciones
ALTER TABLE inscripciones
ADD CONSTRAINT fk_cod_est FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est) 
ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE inscripciones
ADD CONSTRAINT fk_cod_cur FOREIGN KEY (cod_cur) REFERENCES cursos(cod_cur)
ON DELETE CASCADE ON UPDATE CASCADE;

--Agragando los constrain y restricciones  a notas
ALTER TABLE notas
ADD CONSTRAINT fk_cod_cur FOREIGN KEY (cod_cur) REFERENCES cursos(cod_cur)
ON DELETE CASCADE ON UPDATE CASCADE;

--Agragando los constrain y restricciones  a calificaciones
ALTER TABLE calificaciones
ADD CONSTRAINT fk_nota FOREIGN KEY (nota) REFERENCES notas (nota)
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE calificaciones
ADD CONSTRAINT fk_inscripciones FOREIGN KEY (cod_inscripcion)
REFERENCES inscripciones(cod_inscripcion)
ON DELETE CASCADE ON UPDATE CASCADE;

--disparador de la tabla notas 
-- Crear una función que se ejecutará antes de insertar o actualizar en la tabla notas
CREATE OR REPLACE FUNCTION validar_porcentaje()
    RETURNS TRIGGER AS $$
BEGIN
    -- Obtener la suma de los porcentajes para el curso en la nueva fila o la fila actualizada
    SELECT SUM(porcentaje)
    INTO STRICT NEW.suma_porcentajes
    FROM notas
    WHERE cod_cur = NEW.cod_cur;
    
    -- Verificar si la suma de porcentajes excede el 100%
    IF NEW.suma_porcentajes > 100 THEN
        RAISE EXCEPTION 'La suma de porcentajes para el curso supera el 100%%';
    END IF;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Crear el disparador que llamará a la función antes de insertar o actualizar en la tabla notas
CREATE TRIGGER validar_porcentaje_trigger
    BEFORE INSERT OR UPDATE ON notas
    FOR EACH ROW
    EXECUTE FUNCTION validar_porcentaje();

--copiando los datos de los csv
COPY estudiantes FROM '../dates/estudiantes.csv' 
WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'LATIN1');

COPY cursos FROM '../dates/cursos.csv' 
WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'LATIN1');

COPY cursos FROM '/../dates/inscripciones.csv' 
WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'LATIN1');

--si no sirve el "COPY" usar /copy
\copy estudiantes FROM '../dates/estudiantes.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

\copy cursos FROM '../dates/cursos.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

\copy inscripciones FROM '../dates/inscripciones.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

