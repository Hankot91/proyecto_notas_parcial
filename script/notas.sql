CREATE DATABASE notas;

CREATE TABLE estudiantes(
    cod_est INTEGER CHECK (cod_est >= 0) PRIMARY KEY NOT NULL,
    nomb_est VARCHAR(50) NOT NULL
)

CREATE TABLE inscripciones(
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
    cod_cur INTEGER,
    cod_est INTEGER,
    periodo INTEGER,
    anho INTEGER,
    nota VARCHAR(30)
)

//Agragando los constrain y restricciones  a inscripciones//
ALTER TABLE inscripciones 
ADD PRIMARY KEY(periodo, anho, cod_cur, cod_est);
ALTER TABLE inscripciones
ADD CONSTRAINT fk_cod_est FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est);
ALTER TABLE inscripciones
ADD CONSTRAINT fk_cod_cur FOREIGN KEY (cod_cur) REFERENCES cursos(cod_cur);


//Agragando los constrain y restricciones  a notas//
ALTER TABLE notas
ADD CONSTRAINT fk_cod_cur FOREIGN KEY (cod_cur) REFERENCES cursos(cod_cur);


//Agragando los constrain y restricciones  a calificaciones//
ALTER TABLE calificaciones
ADD CONSTRAINT fk_nota FOREIGN KEY (nota) REFERENCES notas (nota);

ALTER TABLE calificaciones
ADD CONSTRAINT fk_periodo FOREIGN KEY (periodo, anho, cod_cur, cod_est)
REFERENCES inscripciones(periodo, anho, cod_cur, cod_est);


COPY estudiantes FROM '../dates/estudiantes.csv' 
WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'LATIN1');

//si no sirve el copy usar este
\copy estudiantes FROM '../dates/estudiantes.csv' 
WITH (FORMAT CSV, DELIMITER ',', HEADER, ENCODING 'latin1');