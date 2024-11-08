--CONSULTAS DE RESUMEN
--Gropu by - having

--Obtener la suma total que se pagar� por hora entre todos los empleados:
select sum(sueldo_hora) [Sueldo por Hora de Empleados] from puesto

--Obtener la suma total del sueldo semanal que se pagara al personal administrativo:
select sum(sueldo_hora*horas)[Suma de Sueldo por Semana Administrativos] from puesto where puesto = 'ADMINISTRATIVO'

--Obtener el promedio de edad de los alumnos del sexo masculino:
select AVG(edad) from Alumno_general where sexo='M'  

--Obtener el promedio de edad de los alumnos del sexo femenino:
select AVG(edad) from Alumno_general where sexo='F'  

--Obtener el promedio de edad de todos los alumnos:
select round(avg(edad),2) [Promedio Edad] from Alumno_general

--Obtener el sueldo por hora mas bajo de los empleados:
select min(sueldo_hora)[Sueldo M�nimo] from Puestoooo

--Obtener el sueldo m�s alto de los administrativos:
select max(sueldo_hora)[Sueldo M�ximo Administrativos] from puesto where puesto ='Administrativo'

--Obtener el total de empleados que tienen preparatoria:
select count (escolaridad) [Empleados con Preparatoria] from Escolaridad where ESTUDIOS='Preparatoria'

--Obtener el total de registros de la tabla alumnos:
select count(*)[Cuenta registros alumnos] from Alumnos

--Obtener el promedio de edad de los alumnos agrupados por sexo:
select avg(edad), sexo from Alumno_general group by SEXO

--Obtener el total de empleados por escolaridad y puesto:
select E.Escolaridad, P.puesto, count(P.puesto) Cantidad from Escolaridad E, Puesto P where E.NUMEMPLEADO = P.NUMEMPLEADO group by E.ESCOLARIDAD, P.PUESTO

--Agregarle estudios:
select E.Estudios, E.Escolaridad, P.puesto,  count(P.puesto) Cantidad from Escolaridad E, Puesto P where E.NUMEMPLEADO = P.NUMEMPLEADO group by E.ESCOLARIDAD, P.PUESTO, E.ESTUDIOS

--Obtener puesto y suma de sueldo por hora de todos los empleados agrupado por puesto y que la suma sueldo sea mayor a 500:
select puesto, sum(sueldo_hora) [Suma Sueldo >500] from Puesto group by Puesto having sum(sueldo_hora)>500