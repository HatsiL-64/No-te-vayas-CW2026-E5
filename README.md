# No-te-vayas-CW2026-E5
Proyecto final del equipo 5 del curso web 2026  

## Indice
1. [Resumen](#resumen)
2. [Levantamiento de requerimentos](#levantamiento-de-requerimentos) 
	- [Bases](#bases-del-proyecto)
	- [Metas y objetivos](#metas-y-objetivos)
	- [Público objetivo](#público-objetivo-ux)
	- [Propósito y alcanse](#propósito-y-alcance)
	- [Especificaiones funcionales](#especificaciones-funcionales)
	- [Requisitos no funcionales](#requisitos-no-funcionales)
	- [Arquitectura de la informacion y UX](#arquitectura-de-la-información-y-ux)
	- [Especificaciones tecnicas](#especificaciones-técnicas)
3. [Guía de instalación](#guía-de-instalación)	
## Resumen

No te vayas, QuedETE, es un sistema de acceso restringido con el propósito de disminuir la deserción del ETE en especial del ETE en computación . El sistema facilita al profesor dar seguimiento y orientación a los alumnos, así como la creación de distintas estrategias personalizadas a partir del perfil de los mismos y a los alumnos les brinda espacios en los que el profesor puede subir recursos para reforzar sus conocimientos.

## Levantamiento de requerimentos 
### Bases del proyecto
Sistema de acceso restringido con tres tipos de usuario: estudiante, profesor y administrador. 

Objetivo general:  

* Brindar información que oriente la planeación de acciones de apoyo al estudiantado para disminuir la deserción.  

Objetivos particulares:   

* Recabar indicadores individuales y grupales para que apoyen la detección de necesidades y características particulares y grupales.  
* Brindar al estudiantado información que lo ayude a tomar decisiones para cumplir objetivos académicos.  
* Brindar al profesor información que lo ayude a crear estrategias para cumplir objetivos académicos.

#### METAS Y OBJETIVOS
  
- **Metas:**
	- Lograr una plataforma intuitiva y llamativa donde se registren alumnos y maestros inscritos en las ETEs.
	- Reducir la deserción de los alumnos de quinto año del Estudio Técnico Especializado en Computación mediante la identificación temprana de indicadores de deserción. 
	- Dar a los estudiantes y a los profesores recursos e información para poder mejorar su trabajo y desempeño en clases. 

          
- **Objetivos:**
	- Crear un sistema que permita a los profesores añadir recursos en línea para ayudar a los alumnos de acuerdo a su situación.
	- Diseñar un sistema con tres niveles de acceso (administrador, profesorado y estudiantes).
	-  Crear un perfil personalizado para los alumnos del ETE en computación con base a un cuestionario 

#### PÚBLICO OBJETIVO (UX)
- Alumnos de primer año del Estudio Técnico Especializado de entre 16 a 18 años, junto con los profesores de la misma asignatura. 

#### PROPÓSITO Y ALCANCE
- **En alcance (Entregables):**

	- Sistema para que los profesores den de alta a sus alumnos con información básica. 
	- Sistema de inicio de sesión y creación de cuenta con base en el registro de los profesores que restrinja la vista de información según el usuario (administrador, profesorado, estudiantes).
	- Cuestionarios para crear perfiles de los alumnos (hábitos de estudio y factores de riesgo).
	- Interfaz para que los profesores ingresen calificaciones y actividades realizadas. 
	- Restricción de información visible según el tipo de usuario
	- Sección de recursos en línea para subir enlaces y archivos.
	- Cédula de información (perfiles) donde se puedan visualizar los resultados del cuestionario inicial (ETE en computación) y los datos académicos.
	- La información académica se registrará con base al grupo y módulo 

- **Fuera de alcance:**
Por el tiempo de desarrollo se excluye: 
	- Creación de gráficas estadísticas automatizadas con base en los datos.
	- Chat asíncrono en tiempo real entre usuarios 
	- Notificaciones y avisos de información ingresada por los alumnos y alertas para atención inmediata.
	- Promedio ponderado para medir riesgo de deserción
 

#### ESPECIFICACIONES FUNCIONALES

|MÓDULO|DESCRIPCIÓN|CRITERIO DE ACEPTACIÓN|
|------|-----------|----------------------|
|Registro|El profesor ingresa No. Cuenta, nombre, fecha de nacimiento, correo.|Valida que los campos no queden vacíos y guarde el registro en la base de datos.
Inicio de sesión | Ingresa número de cuenta y fecha de nacimiento del alumno. | Se verifica que esté coincida con la información en la base de datos y se dirige a la página correspondiente. 
Cuestionario Diagnóstico. | Cuestionario dirigido a los estudiantes del ETE en computación para identificar hábitos de estudio y posibles indicadores de deserción.| Las respuestas se almacenarán en la base de datos y se presentarán en las cédulas de los estudiantes. |

#### REQUISITOS NO FUNCIONALES

|CATEGORÍA    |REQUISITO|
|-------------|---------|
|Accesibilidad|Navegable desde cualquier dispositivo.|
|Privacidad   |Evitar que los estudiantes accedan a información que no les pertenezca y evitar que el profesorado acceda a información de alumnos que no le pertenezca.| 


#### ARQUITECTURA DE LA INFORMACIÓN Y UX
- Barra superior con los logos de la escuela.
- Barra lateral izquierda, con un menú de navegación.
- Alto contraste entre el fondo y el contenido.
- Páginas personalizadas dependiendo del tipo de usuario.

#### ESPECIFICACIONES TÉCNICAS

- **Frontend:** 
HTML 
CSS
- **Backend:**  PHP
- **Base de Datos:**  MaríaDB (base de datos)

## CONVENCIONES
- Todo en español 

- No espacios, ni acentos, ni caracteres especiales para nombres

- Para ramas,  repertorios, y nombres de archivos: minúsculas y guión medio

- id y class: minúsculas y guión bajo

- commits: type(scope): descripción en infinitivo

- Descripción general de la función en la firma de la misma y comentarios de apoyo en puntos importantes.


## GUÍA DE INSTALACIÓN 
**Requisitos previos**:

- Tener XAMPP instalado (en caso de tener un sistema operativo basado en Linux, se puede instalar y configurar Apache directamente)
- Tener MariaDB instalado
- Tener git instalado

Paso 1: Clonar el repositorio en htdocs (para distribuciones linux basadas en debian: /var/www/html).  
Paso 2: Prender el servidor.  
Paso 3: (Cómo descargar la base de datos) y guardarla en la dirección apropiada.
