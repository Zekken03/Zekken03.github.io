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
    password VARCHAR(10),
    idMult INT,
    FOREIGN KEY (idMult) REFERENCES Multimedia(idMult)
);

select * from usuarios u 

-- Tabla Autores
CREATE TABLE Autores (
    idAutor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    biografia VARCHAR(255),
    redes VARCHAR(15),
    idUsuario INT,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

-- Tabla Tipo
CREATE TABLE Tipo (
    idTipo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    descripcion VARCHAR(255),
    tipo VARCHAR(15) CHECK (tipo IN ('Noticia', 'Guía', 'Análisis'))
);

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

-- Insertar datos en Usuarios
INSERT INTO Usuarios (nombre, correo, password, idMult) VALUES
('PabloGamer', 'admin@gmail.com', '123', 5),  -- Autor
('TechMaster', 'techmaster@technews.com', 'tecmaster1', 5), -- Autor
('LunaReview', 'luna.review@hotmail.com', 'luna1234', 5), -- Autor
('GamerFan', 'gamerfan@hotmail.com', 'gamer123', 5),
('TechGuru', 'techguru@gmail.com', 'techguru45', 5),
('PlayerOne', 'playerone@yahoo.com', 'password1', 5);

-- Insertar datos en Autores
INSERT INTO Autores (biografia, redes, idUsuario) VALUES
('Amante de los RPG y editor profesional.', 'twitter.com/JuanGamer', 1),
('Especialista en hardware y software tecnológico.', 'linkedin.com/in/techmaster', 2),
('Apasionada de los indies y los análisis narrativos.', 'instagram.com/LunaReview', 3);

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
where idPubli=1;
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
(2, 5, 'Gracias por esta comparativa, muy útil.', '2024-11-23 10:20:00'),
(3, 6, 'La guía está súper completa, ¡buen trabajo!', '2024-11-25 18:45:00'),
(4, 4, 'Este juego es increíble, el análisis es perfecto.', '2024-11-26 12:30:00');

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



drop trigger ACTUALIZAR;
drop table control_actualizacion;

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

CREATE PROC INSERTAR 
@titulo varchar (100),
@contenido text,
@fechaPubli date,
@idAutor int,
@idTipo int,
@idMult int,
AS 
BEGIN
INSERT INTO Publi 
VALUES (@titulo,@contenido,@fechaPubli,@idAutor,@idTipo,@idMult)
end

EXEC INSERTAR '','','','',''
