DROP TABLE IF EXISTS videocentro;
CREATE TABLE videocentro (
	id 		SERIAL NOT NULL,
	nombre 		VARCHAR (255),
	direccion	VARCHAR (255),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS categoria;
CREATE TABLE categoria (
	id 		SERIAL NOT NULL,
	nombre 		VARCHAR (255),
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS pelicula;
CREATE TABLE pelicula (
	id SERIAL NOT NULL,
	nombre VARCHAR (255) NOT NULL,
	id_categoria INTEGER NOT NULL,
	id_videocentro INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (id_categoria) REFERENCES categoria,
	FOREIGN KEY (id_videocentro) REFERENCES videocentro
);

-- INSERTS TO CATEGORIAS --
INSERT INTO categoria (nombre) VALUES ('Humor');
INSERT INTO categoria (nombre) VALUES ('Terror');
INSERT INTO categoria (nombre) VALUES ('Super heroes');
INSERT INTO categoria (nombre) VALUES ('Romance');
INSERT INTO categoria (nombre) VALUES ('Drama');
INSERT INTO categoria (nombre) VALUES ('Suspenso');
INSERT INTO categoria (nombre) VALUES ('Animacion');

-- INSERTS TO VIDEOCENTROS --
INSERT INTO videocentro (nombre, direccion) VALUES ('Sucursal Norte', 'Blvd. Miguel de Cervantes Saavedra 303, Granada, Miguel Hidalgo, 11529 Ciudad de México, CDMX');
INSERT INTO videocentro (nombre, direccion) VALUES ('Sucursal Sur', 'América, La Concepción, Parque San Andrés, Ciudad de México, CDMX');
INSERT INTO videocentro (nombre, direccion) VALUES ('Sucursal Oriente', 'Av Telecomunicaciones 17, Renovación, 09209 Ciudad de México, CDMX');
INSERT INTO videocentro (nombre, direccion) VALUES ('Sucursal poniente', 'Via Magna 3, Bosque de las Palmas, 52787 Naucalpan de Juárez, Méx.');

-- UPDATE TABLE pelicula WITH id_videocentro
UPDATE pelicula SET id_videocentro = 1 WHERE id=3;
UPDATE pelicula SET id_videocentro = 1 WHERE id=4;

UPDATE pelicula SET id_videocentro = 3 WHERE id=9;
UPDATE pelicula SET id_videocentro = 3 WHERE id=10;

-- Todos los video centros
SELECT id, nombre FROM pelicula WHERE id_videocentro IS NULL LIMIT 10;
