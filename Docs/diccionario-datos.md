**Tabla: Usuario**

|Campo|Tipo de dato|Descripción|
|-----|------------|-----------|
|id_usuario|UNSIGNED INT|Concatenación del tipo de usuario y el identificador de la tabla según su tipo de usuario. Para el estudiante 1+número de cuenta, para el profesor 2+número de trabajador|
|nombre|CHAR|Nombre(s) del usuario.|
|apellido_paterno|VARCHAR|Apellido paterno del usuario.|
|apellido_materno|VARCHAR|Apellido materno del usuario.|
|correo|VARCHAR|Correo del usuario.|
|contraseña|VARCHAR|Contraseña del usuario. Para el alumno sera el dia de nacimiento en formato DDMMYYYY| 
|tipo_usuario|VARCHAR(1)|1 para alumno, 2 para profesor y 3 para administrador.|

**Tabla: Alumno**

|Campo|Tipo de dato|Descripción|
|-----|------------|-----------|
|id_alumno|UNSIGNED INT|Número de cuenta del alumno|
|id_usuario|UNSIGNED INT|Concatenación del tipo de usuario y el número de cuenta|
|id_grupo_uno|VARCHAR|Identificador de número y letras del grupo.|
|id_grupo_dos|VARCHAR|Identificador de número y letras del grupo. Opcional según si están en otra ETE|
|deserción|TINYINT|Indicador en caso de que el alumno se dé de baja.|
|prom_he|TINYINT|Promedio de algo xd|
|prom_t|TINYINT|Promedio|
|prom_aa|TINYINT|Promedio|
|prom_ec|TINYINT|Promedio|
|prom_mye|TINYINT|Promedio|
|perfil|TINYINT|Perfil del usuario|
|riesgo_desercion|FLOAT|Riesgo de desertar|

**Tabla: Profesor**

|Campo|Tipo de dato|Descripción|
|-----|------------|-----------|
|id_profesor|UNSIGNED INT|Número de trabajador|
|id_usuario|UNSIGNED INT|Concatenación del tipo de usuario y el número de trabajador|

**Tabla: ETE**

|Campo|Tipo de dato|Descripción|
|-----|------------|-----------|
|id_ete|VARCHAR|Identificador del ETE|
|nombre|VARCHAR|Nombre de la ETE (computación, histopatología, etc)|

**Tabla: Grupos Registrados**

|Campo|Tipos de dato|Descripción|
|-----|-------------|-----------|
|id_grupo|VARCHAR|Identificador único del grupo|
|nombre_grupo|VARCHAR|Nombre del grupo|
|id_ete|VARCHAR|Identificador del ETE|
|plantel|UNSIGNED INT|Plantel en el que se imparte|

**Tabla: Módulo**

|Campo|Tipo de dato|Descripción|
|-----|------------|-----------|
|id_modulo|VARCHAR|Abreviatura del tipo de ETE + el número del módulo (comp1, histo1)|
|id_ete|VARCHAR|Identificador del ETE.|
|numero|TINYINT|Numero de modulo de la respectiva ete|
|nombre|VARCHAR|Nombre del módulo|


