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
    valor FLOAT CHECK(valor >= 0 AND valor <= 5),
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
-- función validar_porcentaje para verificar la suma de porcentajes
CREATE OR REPLACE FUNCTION validar_porcentaje()
    RETURNS TRIGGER AS $$
BEGIN
    -- Verificar si la suma de porcentajes para el curso supera el 100%
    IF EXISTS (
        SELECT 1
        FROM notas
        WHERE cod_cur = NEW.cod_cur
        GROUP BY cod_cur
        HAVING SUM(porcentaje) > 100
    ) THEN
        RAISE EXCEPTION 'La suma de porcentajes para el curso supera el 100%%';
    END IF;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- disparador validar_porcentaje
CREATE TRIGGER validar_porcentaje_trigger
    AFTER INSERT OR UPDATE ON notas
    FOR EACH ROW
    WHEN (NEW.cod_cur IS NOT NULL) 
    EXECUTE FUNCTION validar_porcentaje();


--función para obtener las calificaciones ponderadas de manera dinamica
CREATE OR REPLACE FUNCTION obtener_calificaciones_ponderadas(
    codigo_estudiante INTEGER
)
RETURNS TABLE (
    Curso VARCHAR,
    Notas TEXT[],
    Total DECIMAL(5,2)
)
AS $$
DECLARE
    curso_actual VARCHAR;
    notas_actuales TEXT[];
BEGIN
    FOR curso_actual IN
        SELECT DISTINCT cursos.nomb_cur
        FROM
            estudiantes
            INNER JOIN inscripciones ON estudiantes.cod_est = inscripciones.cod_est
            INNER JOIN cursos ON inscripciones.cod_cur = cursos.cod_cur
        WHERE
            estudiantes.cod_est = codigo_estudiante
    LOOP
        SELECT ARRAY_AGG(calificaciones.valor)
        INTO notas_actuales
        FROM
            estudiantes
            INNER JOIN inscripciones ON estudiantes.cod_est = inscripciones.cod_est
            INNER JOIN cursos ON inscripciones.cod_cur = cursos.cod_cur
            INNER JOIN calificaciones ON inscripciones.cod_inscripcion = calificaciones.cod_inscripcion
            INNER JOIN notas ON calificaciones.nota = notas.nota
        WHERE
            estudiantes.cod_est = codigo_estudiante
            AND cursos.nomb_cur = curso_actual;

        SELECT
            cursos.nomb_cur AS Curso,
            notas_actuales AS Notas,
            SUM(calificaciones.valor * notas.porcentaje)/100 AS Total
        INTO
            Curso,
            Notas,
            Total
        FROM
            estudiantes
            INNER JOIN inscripciones ON estudiantes.cod_est = inscripciones.cod_est
            INNER JOIN cursos ON inscripciones.cod_cur = cursos.cod_cur
            INNER JOIN calificaciones ON inscripciones.cod_inscripcion = calificaciones.cod_inscripcion
            INNER JOIN notas ON calificaciones.nota = notas.nota
        WHERE
            estudiantes.cod_est = codigo_estudiante
            AND cursos.nomb_cur = curso_actual
        GROUP BY
            cursos.nomb_cur;

        RETURN NEXT;
    END LOOP;
END
$$ LANGUAGE plpgsql;

--si no sirve el "COPY" usar /copy
\copy estudiantes FROM '../dates/estudiantes.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

\copy cursos FROM '../dates/cursos.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

\copy inscripciones FROM '../dates/inscripciones.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

\copy notas FROM '../dates/notas.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

\copy calificaciones FROM '../dates/calificaciones.csv' WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');

