create database gamesnow;
drop database gamesnow;

use gamesnow;
-- Tabla Multimedia
CREATE TABLE Multimedia (
    idMult INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(15) CHECK (estado IN ('Imagen', 'Video', 'Audio')),
    url VARCHAR(255),
    descripcion VARCHAR(255)
);

-- Tabla Usuarios
CREATE TABLE Usuarios (
    idUsuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    correo VARCHAR(100),
    password VARCHAR(10)
);


-- Tabla Autores
CREATE TABLE Autores (
    idAutor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    biografia VARCHAR(255),
    redes VARCHAR(15),
    idUsuario INT,
    idMult int,
    FOREIGN KEY (idMult) REFERENCES Multimedia(idMult),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);
ALTER TABLE Usuarios
DROP COLUMN idMult;

ALTER TABLE Autores
ADD COLUMN idMult INT,
ADD FOREIGN KEY (idMult) REFERENCES Multimedia(idMult);

select* from usuarios u 

SHOW CREATE TABLE Usuarios;

ALTER TABLE Usuarios
DROP FOREIGN KEY usuarios_ibfk_1;




-- Tabla Tipo
CREATE TABLE Tipo (
    idTipo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    descripcion VARCHAR(255),
    tipo VARCHAR(15) CHECK (tipo IN ('Noticia', 'Guía', 'Análisis'))
);

select * from comentarios c 
-- Tabla Etiquetas
CREATE TABLE Etiquetas (
    idEtiqueta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

-- Tabla Publicaciones
CREATE TABLE Publi (
    idPubli INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    contenido TEXT,
    fechaPubli DATE,
    idAutor INT,
    idTipo INT,
    idMult INT,
    FOREIGN KEY (idAutor) REFERENCES Autores(idAutor),
    FOREIGN KEY (idTipo) REFERENCES Tipo(idTipo),
    FOREIGN KEY (idMult) REFERENCES Multimedia(idMult)
);

ALTER TABLE Publi MODIFY titulo VARCHAR(255);


-- Tabla Tag
CREATE TABLE Tag (
    idTag INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idEtiqueta INT,
    idPubli INT,
    FOREIGN KEY (idEtiqueta) REFERENCES Etiquetas(idEtiqueta),
    FOREIGN KEY (idPubli) REFERENCES Publi(idPubli)
);

-- Tabla Comentarios
CREATE TABLE Comentarios (
    idComentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idPubli INT,
    idUsuario INT,
    comentario TEXT,
    fecha DATETIME,
    FOREIGN KEY (idPubli) REFERENCES Publi(idPubli),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

-- Insertar datos en Multimedia
INSERT INTO Multimedia (estado, url, descripcion) VALUES
('Imagen', 'ubi.webp', 'Imagen de Ubisoft'),
('Imagen', 'palworld.webp', 'Imagen de Palworld'),
('Imagen', 'lag.webp', 'Imagen diseñada GPU'),
('Imagen', 'amd.webp', 'Imagen de AMD'),
('Imagen', 'user.webp', 'Foto');

SELECT idMult FROM Multimedia WHERE url = 'user.webp';

UPDATE Autores
SET idMult = 5 where idAutor = 3; 

-- Insertar datos en Usuarios
INSERT INTO Usuarios (nombre, correo, password) VALUES
('PabloGamer', 'admin@gmail.com', '123'),  -- Autor
('TechMaster', 'techmaster@technews.com', 'tecmaster1'), -- Autor
('LunaReview', 'luna.review@hotmail.com', 'luna1234');

-- Insertar datos en Autores
INSERT INTO Autores (biografia, redes, idUsuario, idMult) VALUES
('Amante de los RPG y editor profesional.', 'twitter.com/JuanGamer', 1, 5),
('Especialista en hardware y software tecnológico.', 'linkedin.com/in/techmaster', 2,5 ),
('Apasionada de los indies y los análisis narrativos.', 'instagram.com/LunaReview', 3, 5);

SELECT u.*, a.biografia, a.redes
        FROM Usuarios u
        JOIN Autores a ON u.idUsuario = a.idUsuario
        ORDER BY u.idUsuario DESC;

-- Insertar datos en Etiquetas
INSERT INTO Etiquetas (nombre) VALUES
('PC'),
('Móviles'),
('Trucos'),
('Hardware'),
('Esports'),
('Tecnología');

-- Insertar datos en Tipo
INSERT INTO Tipo (nombre, descripcion, tipo) VALUES
('Noticia rápida', 'Noticias breves de videojuegos', 'Noticia'),
('Guía rápida', 'Guía detallada sobre un videojuego', 'Guía'),
('Análisis rápido', 'Reseña exhaustiva de un título', 'Análisis');

select * from Tipo order by idTipo DESC
select * from publi p 
SELECT * FROM autores a 
select * from comentarios c 
select * from Usuarios where idUsuario<4 order by idUsuario DESC

-- Insertar datos en Publicaciones
INSERT INTO Publi (titulo, contenido, fechaPubli, idAutor, idTipo, idMult) VALUES
('Ubisoft podría ser adquirida por Tencent: ambas compañías están en conversaciones para un posible acuerdo de compra', 'Un análisis de lo que podemos esperar', '2024-11-20', 1, 1, 1),
('A pesar de la demanda de Nintendo, Palworld lanzará versiones para iOS y Android, desarrolladas por los creadores de PUBG', 'Las novedades para móviles', '2024-11-22', 2, 1, 2),
('Un jugador se da cuenta tras cuatro años que su monitor estaba conectado a la GPU integrada en lugar de a su tarjeta gráfica', 'Problemas de esta época', '2024-11-25', 3, 2, 3),
('AMD despedirá a un 4% de su plantilla, en torno a 1.000 empleados', 'El futuro de AMD', '2024-11-26', 1, 3, 4);

drop table publi;
ALTER TABLE Publi MODIFY COLUMN titulo VARCHAR(255);
update publi set titulo ='AMD despedirá a un 4% de su plantilla, en torno a 1.000 empleados'
where idPubli = 4;


	update Publi set contenido='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue eros sed ultricies porta. Proin fermentum vestibulum feugiat. Proin ut mi diam. Vivamus ipsum nunc, aliquam cursus feugiat ut, volutpat et nulla. Mauris fringilla sapien arcu, a blandit urna gravida sit amet. Duis congue sit amet nibh nec sodales. Nunc varius tincidunt ultricies. Donec non quam vitae nisl blandit vulputate. Sed nec fringilla ex. Proin volutpat dui vitae tincidunt sodales. Sed porta aliquet velit at scelerisque. Quisque at orci odio. Maecenas efficitur pellentesque erat.
	Ut sapien massa, placerat id blandit et, hendrerit ac sem. Donec imperdiet placerat augue, eget finibus metus ornare vulputate. Duis id nulla ut lorem blandit interdum eu id arcu. Curabitur nec lacinia ex, vel facilisis lacus. Nulla tincidunt nec orci nec porta. Fusce ut lectus pharetra, rhoncus orci eget, dignissim sapien. Maecenas ac ipsum ut orci posuere sagittis nec et nisl.
	Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eget scelerisque nunc. Nulla sed sem felis. Nullam venenatis ante nec nisl fermentum consequat. Fusce sit amet nisi cursus, faucibus metus eu, efficitur nibh. Praesent hendrerit mattis elit at sagittis. Aliquam tortor arcu, tristique vitae magna ut, egestas blandit felis. Duis a facilisis eros. Nam dapibus magna turpis, eu accumsan purus pharetra nec. Fusce eget sollicitudin ante. In luctus ut orci a faucibus. Donec congue pulvinar libero et porttitor. Sed nec enim tincidunt, dignissim dui at, blandit tellus. Vivamus pretium leo eget lectus vestibulum, eu interdum odio efficitur. Etiam feugiat aliquam urna vitae pretium. Suspendisse eget porta erat, vitae efficitur diam.
	Integer ac massa semper, suscipit turpis eget, malesuada tortor. Morbi quis neque pharetra, porta turpis ut, eleifend nisl. Nulla facilisi. Nullam sed efficitur leo. Mauris congue venenatis eros eu ullamcorper. Ut at libero blandit, efficitur magna at, varius ante. Vestibulum quis est molestie, rhoncus sapien in, tempor metus. Curabitur id egestas diam. Phasellus dapibus congue nunc in interdum. Morbi in tempus orci. Sed eget dictum risus. Sed sit amet blandit orci. Donec fermentum leo nibh, a elementum diam convallis sit amet.
	Duis urna lectus, tristique et lectus efficitur, posuere fermentum risus. Cras quis sapien porttitor, tempus nulla fringilla, pretium nulla. Nulla tristique eget turpis a accumsan. Nulla vitae massa non mi accumsan suscipit non non leo. Etiam aliquam interdum tempor. Vestibulum vel tristique arcu. Nunc finibus lectus eget auctor lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur commodo tincidunt massa vel rutrum. Morbi eu lobortis sapien, ac porta purus.'
	where idPubli=2;


update Publi set titulo ='Un jugador se da cuenta tras cuatro años que su monitor estaba conectado a la GPU integrada en lugar de a su tarjeta gráfica' where idPubli =3;
-- Insertar datos en Tag
INSERT INTO Tag (idEtiqueta, idPubli) VALUES
(1, 1),
(3, 1),
(2, 2),
(6, 3),
(6, 4);

-- Insertar datos en Comentarios
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(1, 4, 'Estoy muy emocionado por esta nueva consola.', '2024-11-21 14:35:00'),
(2, 4, 'Gracias por esta comparativa, muy útil.', '2024-11-23 10:20:00'),
(3, 4, 'La guía está súper completa, ¡buen trabajo!', '2024-11-25 18:45:00'),
(4, 4, 'Este juego es increíble, el análisis es perfecto.', '2024-11-26 12:30:00');


INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
-- Comentarios para la publicación 1
(1, 23, 'Estoy muy emocionado por esta nueva consola.', '2024-11-21 14:35:00'),
(1, 22, '¿Alguien sabe si tendrá retrocompatibilidad?', '2024-11-21 15:50:00'),
(1, 21, 'Esta consola parece un cambio total en la industria.', '2024-11-22 09:10:00'),
(1, 20, 'Gracias por el análisis tan detallado.', '2024-11-22 12:45:00'),
(1, 19, 'No puedo esperar a que salga.', '2024-11-22 17:30:00'),

-- Comentarios para la publicación 2
(2, 18, 'Gracias por esta comparativa, muy útil.', '2024-11-23 10:20:00'),
(2, 17, 'Creo que esta opción es la mejor calidad-precio.', '2024-11-23 11:00:00'),
(2, 16, '¡Este análisis me ayudó mucho a decidir!', '2024-11-23 14:15:00'),
(2, 15, 'Muy buena guía, gracias.', '2024-11-23 18:25:00'),
(2, 23, 'Ahora sí tengo claro qué consola comprar.', '2024-11-24 09:40:00'),

-- Comentarios para la publicación 3
(3, 22, 'La guía está súper completa, ¡buen trabajo!', '2024-11-25 18:45:00'),
(3, 21, 'Muy informativa y bien explicada.', '2024-11-25 19:10:00'),
(3, 20, 'Sin duda, una de las mejores guías que he leído.', '2024-11-25 20:25:00'),
(3, 19, 'Gracias, me ha sido de gran ayuda.', '2024-11-25 21:50:00'),
(3, 18, 'Me encantó la manera en que explican los detalles.', '2024-11-26 08:15:00'),

-- Comentarios para la publicación 4
(4, 17, 'Este juego es increíble, el análisis es perfecto.', '2024-11-26 12:30:00'),
(4, 16, 'Me dieron ganas de comprarlo ya mismo.', '2024-11-26 13:15:00'),
(4, 15, '¡Qué gran reseña, gracias!', '2024-11-26 15:20:00'),
(4, 23, 'Espero ver más contenido como este.', '2024-11-26 16:40:00'),
(4, 22, 'Muy buena reseña, de verdad.', '2024-11-26 18:10:00');



--------------------------------------------------DISPARADOR-----------------------------------------------------------------------------------------
CREATE TABLE CONTROL_ACTUALIZACION(
idPubli integer,
mensaje CHAR(30),
fecha DATE)

select * from control_actualizacion;

CREATE TRIGGER ACTUALIZAR
AFTER UPDATE ON Publi
FOR EACH ROW
BEGIN
    -- Verifica si el campo 'nombre' ha sido actualizado
     -- Verificar si hubo cambios en los campos específicos
    IF OLD.titulo != NEW.titulo  THEN
       
        INSERT INTO CONTROL_ACTUALIZACION (idPubli, Mensaje, fecha)
        VALUES (NEW.idPubli, 'NUEVO ARTÍCULO AGREGADO', NOW());
    END IF;
END;

-------------------------------------------------------------------------------------------------------------------------------------------------------

drop trigger ACTUALIZAR;
drop table control_actualizacion;




delete from publi where idPubli >5;


select * from publi ;
SELECT * FROM Tipo WHERE idTipo = '2';
select * from autores a; 



---------------------------------------------------------------PROCEDIMIENTO-------------------------------------------------------------------
CREATE PROCEDURE InsertarPubli(
    IN p_titulo VARCHAR(100),
    IN p_contenido TEXT,
    IN p_fechaPubli DATE,
    IN p_idAutor INT,
    IN p_idTipo INT,
    IN p_idMult INT
)
BEGIN
    INSERT INTO Publi (titulo, contenido, fechaPubli, idAutor, idTipo, idMult)
    VALUES (p_titulo, p_contenido, p_fechaPubli, p_idAutor, p_idTipo, p_idMult);
END 


CREATE PROCEDURE InsertarUsuario(
    IN p_nombre VARCHAR(30),
    IN p_correo VARCHAR(100),
    IN p_password VARCHAR(10)
)
BEGIN
    INSERT INTO Usuarios (nombre, correo, password)
    VALUES (p_nombre, p_correo, p_password);
END;



CREATE PROCEDURE InsertarAutor(
    IN nombreCompleto VARCHAR(100),
    IN biografia VARCHAR(255),
    IN redes VARCHAR(15),
    IN correo VARCHAR(100),
    IN password VARCHAR(10),
    IN apellidos VARCHAR(100)
)
BEGIN
    -- Verificamos si el correo ya existe
    IF NOT EXISTS (SELECT 1 FROM Usuarios WHERE correo = correo) THEN
        -- Insertamos el usuario en la tabla Usuarios con el campo de apellidos
        INSERT INTO Usuarios (nombre, correo, password, apellidos)
        VALUES (nombreCompleto, correo, password, apellidos);
        
        -- Insertamos en la tabla Autores, asociando el usuario recién insertado
        INSERT INTO Autores (biografia, redes, idUsuario)
        VALUES (biografia, redes, 
                (SELECT idUsuario FROM Usuarios WHERE correo = correo LIMIT 1));
    ELSE
        -- Si ya existe el correo, lanzamos un error
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El correo ya está registrado.';
    END IF;
END
-------------------------------------------------------------------------------------------------------------------------------------------------------

DROP PROCEDURE IF exists InsertarUsuario; 
DROP PROCEDURE IF EXISTS InsertarAutor;



SELECT idUsuario FROM Usuarios WHERE correo = '$correo'

ALTER TABLE Usuarios ADD CONSTRAINT unique_correo UNIQUE (correo);
ALTER TABLE Usuarios ADD CONSTRAINT unique_password UNIQUE (password);
SELECT * FROM Usuarios WHERE correo = '';

DELETE FROM autores where idAutor=4;
SELECT * FROM autores a 
SELECT * FROM usuarios u 
SELECT * FROM publi p 
SELECT * FROM comentarios c 

delete from publi where idPubli>26;


CALL InsertarAutor('Nombre', 'Biografía', 'Redes', 'correo@example.com', 'contraseña', 1);



delete from AUTORES where idAutor>3
delete from publi where idPubli>4
delete from usuarios where idUsuario>9
select * from autores a 
select * from usuarios u 
select * from publi p 


SELECT publi.*, usuarios.nombre AS autor_nombre, tipo.tipo, autores.biografia, autores.redes, multimedia.*, autores.*
    FROM publi
    JOIN usuarios ON publi.idAutor = usuarios.idUsuario
    JOIN tipo ON publi.idTipo = tipo.idTipo
    JOIN autores ON usuarios.idUsuario = autores.idUsuario
    JOIN multimedia ON publi.idMult = multimedia.idMult
    ORDER BY publi.idPubli asc
    
    SELECT * FROM Autores WHERE idUsuario = 32
    
    INSERT INTO Publi (titulo, contenido, fechaPubli, idAutor, idTipo, idMult) 
                  VALUES ('$titulo', '$contenido', '$fechaPubli', '$idAutor', '$idTipo', '$idMult')
                  
                  
                  
                  SELECT * FROM Publi ORDER BY idPubli DESC LIMIT 10;

SELECT usuarios.idUsuario, autores.idUsuario
FROM usuarios
LEFT JOIN autores ON usuarios.idUsuario = autores.idUsuario
WHERE usuarios.idUsuario IN (SELECT idAutor FROM publi);
                 

SELECT idUsuario, idAutor FROM autores;

SELECT idAutor, COUNT(*) as publicaciones 
FROM publi 
GROUP BY idAutor;


                SELECT publi.*, usuarios.*, tipo.*, autores.*, multimedia.*
FROM publi
LEFT JOIN usuarios ON publi.idAutor = usuarios.idUsuario
LEFT JOIN tipo ON publi.idTipo = tipo.idTipo
LEFT JOIN autores ON usuarios.idUsuario = autores.idUsuario
LEFT JOIN multimedia ON publi.idMult = multimedia.idMult
ORDER BY publi.idPubli ASC;

SELECT usuarios.idUsuario, usuarios.nombre, autores.idUsuario 
FROM usuarios
LEFT JOIN autores ON usuarios.idUsuario = autores.idUsuario
WHERE autores.idUsuario IS NULL;


SELECT publi.*, 
       COALESCE(usuarios.nombre, 'Desconocido') AS nombre, 
       tipo.tipo, 
       COALESCE(autores.biografia, 'No disponible') AS biografia, 
       COALESCE(autores.redes, 'No disponible') AS redes, 
       multimedia.*, 
       autores.*
FROM publi
LEFT JOIN usuarios ON publi.idAutor = usuarios.idUsuario
LEFT JOIN tipo ON publi.idTipo = tipo.idTipo
LEFT JOIN autores ON usuarios.idUsuario = autores.idUsuario
LEFT JOIN multimedia ON publi.idMult = multimedia.idMult
ORDER BY publi.idPubli ASC;

SELECT publi.*, 
       COALESCE(usuarios.nombre, 'Desconocido') AS nombre, 
       tipo.tipo, 
       COALESCE(autores.biografia, 'No disponible') AS biografia, 
       COALESCE(autores.redes, 'No disponible') AS redes, 
       multimedia.*, 
       autores.*
FROM publi
LEFT JOIN usuarios ON publi.idAutor = usuarios.idUsuario
LEFT JOIN tipo ON publi.idTipo = tipo.idTipo
LEFT JOIN autores ON usuarios.idUsuario = autores.idUsuario
LEFT JOIN multimedia ON publi.idMult = multimedia.idMult
WHERE publi.idAutor IS NOT NULL AND publi.idTipo IS NOT NULL
ORDER BY publi.idPubli ASC;

SELECT * FROM publi WHERE idAutor NOT IN (SELECT idAutor FROM autores);

SELECT p.idPubli, p.idAutor
FROM publi p
LEFT JOIN usuarios u ON p.idAutor = u.idUsuario
WHERE u.idUsuario IS NULL;


--CAMBIOS---
ALTER TABLE autores
ADD CONSTRAINT fk_autores_usuarios
FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
ON DELETE CASCADE;

select * from autores a 
select * from usuarios u 
select * from publi p 
select * from comentarios c 
select * from tipo t 

ALTER TABLE autores AUTO_INCREMENT = 1;
ALTER TABLE publi AUTO_INCREMENT = 1;
ALTER TABLE tag  AUTO_INCREMENT = 1;
ALTER TABLE usuarios  AUTO_INCREMENT = 1;
ALTER TABLE comentarios  AUTO_INCREMENT = 1;


UPDATE autores a
JOIN usuarios u ON a.idUsuario = u.idUsuario
SET a.idUsuario = u.idUsuario
WHERE a.idUsuario != u.idUsuario;

DELETE FROM usuarios  WHERE idUsuario> 3;

SELECT * FROM usuarios WHERE idUsuario = 32;
SELECT * FROM autores WHERE idUsuario = 32;

SHOW TABLE STATUS LIKE 'autores';
SHOW TABLE STATUS LIKE 'publi';

DELETE FROM  publi  ;

SHOW CREATE TABLE Autores;

ALTER TABLE autores DROP FOREIGN KEY autores_ibfk_1;

ALTER TABLE autores
DROP FOREIGN KEY fkIdUsuario;  -- O usa el nombre de la clave foránea anterior

ALTER TABLE autores
ADD CONSTRAINT fkIdUsuario
FOREIGN KEY (idUsuario) 
REFERENCES usuarios(idUsuario) 
ON DELETE CASCADE;

SHOW TABLE STATUS WHERE Name = 'autores';
SHOW TABLE STATUS WHERE Name = 'usuarios';


CONSTRAINT `fkIdUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE

select u.*, a.* from Autores a JOIN  usuarios u on u.idUsuario = a.idUsuario order by a.idAutor desc

INSERT INTO Usuarios (nombre, correo, password) VALUES 
('ShadowHunter', 'shadowhunter@example.com', 'hunter123'),
('NightWolf', 'nightwolf@example.com', 'wolf321'),
('PixelMaster', 'pixelmaster@example.com', 'pixel1234'),
('XxGamerKingxX', 'gamerking@example.com', 'kinggamer23'),
('CyberSlayer', 'cyberslayer@example.com', 'slayer456'),
('LunarKnight', 'lunarknight@example.com', 'knight789'),
('BladeRunner', 'bladerunner@example.com', 'runner1122'),
('EchoFox', 'echofox@example.com', 'echo1234'),
('StealthAssassin', 'stealthassassin@example.com', 'stealthass@ss'),
('NinjaWarrior', 'ninjawarrior@example.com', 'warrior345');

select * from publi p 

-- Comentarios para la guía de Horizon Forbidden West
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(15, 26, '¡Gracias por la guía! Me ayudó mucho con los trucos de combate y las misiones secundarias.', NOW()),
(15, 27, '¡Muy útil! Ahora sé cómo mejorar mis habilidades y enfrentar a los enemigos más duros.', NOW()),
(15, 28, 'Me encantó la forma en que cubres las mecánicas de exploración. Definitivamente volveré a consultar esta guía.', NOW()),
(15, 29, '¡Gran trabajo! Tus consejos sobre los vehículos fueron muy útiles. ¡Ahora no tengo miedo a las máquinas!', NOW());

-- Comentarios para la guía de Red Dead Redemption 2
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(13, 30, 'Me ha encantado la guía. Ahora soy mucho mejor en el duelo y la caza.', NOW()),
(13, 31, '¡Excelente trabajo! Los consejos sobre la moralidad me ayudaron a tomar decisiones más acertadas.', NOW()),
(13, 32, 'Muy detallada. Ahora sé cómo optimizar mi campamento y ganar más dinero.', NOW()),
(13, 33, 'Las recomendaciones sobre las misiones secundarias son geniales. Ahora puedo disfrutar del juego al máximo.', NOW());

-- Comentarios para la guía de Echoes of Wisdom
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(14, 35, 'Echoes of Wisdom es increíble, pero me perdí en algunas partes del mapa. ¡Gracias por la guía!', NOW()),
(14, 30, '¡Gran trabajo! Me ayudaste a entender mejor las mecánicas de combate y la historia detrás de cada misión.', NOW()),
(14, 33, 'Me encanta el enfoque en las decisiones críticas. Esta guía realmente me hace pensar en cada elección que hago.', NOW());

-- Comentarios para la guía de Cyberpunk 2077
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(16, 26, 'Cyberpunk es un caos, pero con esta guía puedo sobrevivir. ¡Gracias por las recomendaciones sobre habilidades!', NOW()),
(16, 28, '¡Excelente! Ya no tengo miedo de las pandillas de Night City. Los consejos sobre armas me fueron muy útiles.', NOW()),
(16, 23, '¡Me encantó! Ahora puedo hackear sin problemas y hacer misiones de manera más eficiente.', NOW()),
(16, 29, 'Los trucos para mejorar el sigilo me han ayudado mucho. ¡Ya no me descubren tan fácilmente!', NOW());

-- Comentarios para el análisis de Black Myth Wukong
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(8, 30, '¡Este juego se ve impresionante! No puedo esperar a que salga. Las mecánicas de combate parecen épicas.', NOW()),
(8, 28, 'Lo que más me emociona es la historia y la jugabilidad. Es como un Dark Souls con mitología china.', NOW()),
(8, 26, 'La jugabilidad en el tráiler es brutal. Si mantienen esta calidad, será uno de los mejores juegos de acción.', NOW());

-- Comentarios para el análisis de Dead Rising Remaster
INSERT INTO Comentarios (idPubli, idUsuario, comentario, fecha) VALUES
(12, 27, '¡Me encanta Dead Rising! Este remaster tiene gráficos impresionantes, aunque me gustaría ver más novedades.', NOW()),
(12, 33, '¡Muy bueno! El remaster de Dead Rising ha mejorado mucho, pero las mecánicas siguen siendo tan divertidas como antes.', NOW()),
(12, 31, 'El sistema de zombis nunca envejece. ¡Este remaster me trae muchos recuerdos!', NOW());

SELECT Publi.idPubli, Publi.titulo, Publi.contenido, Usuarios.nombre, Multimedia.idMult, Multimedia.estado, Multimedia.url, Multimedia.descripcion
        FROM Publi
        INNER JOIN Usuarios ON Publi.idAutor = Usuarios.idUsuario
        INNER JOIN Multimedia ON Publi.idMult = Multimedia.idMult
        WHERE Publi.idPubli = 12

ALTER TABLE usuarios
MODIFY COLUMN password VARCHAR(100);
ALTER TABLE publi CHANGE título titulo VARCHAR(255);
