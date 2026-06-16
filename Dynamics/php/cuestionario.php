<?php
    session_start();
    include 'layout.php';
    include 'config.php';
    if($_SESSION["tipo_usuario"] != 1){
        header("Location: inicio.php");
        exit();    
    }
    $usuario = $_SESSION['usuario'];

    $sql1= "SELECT id_alumno FROM alumnos WHERE id_usuario = $usuario";
    $resultado = mysqli_query($conexion, $sql1);
    $fila1 = mysqli_fetch_assoc($resultado);
    $id_alumno = $fila1['id_alumno'];

    $sql= "SELECT id_grupo1 FROM alumnos WHERE id_usuario = $usuario";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $id_grupo1 = $fila['id_grupo1'];
    $sql2= "SELECT id_ete FROM grupos WHERE id_grupo = '$id_grupo1'";
    $resultado = mysqli_query($conexion, $sql2);
    $fila2 = mysqli_fetch_assoc($resultado);
    $id_ete = $fila2['id_ete'];
    echo $id_ete;
    if($id_ete == 'CM1' || $id_ete == 'CM2' ||$id_ete == 1)
    {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/cuestionario.css">
</head>
<body>
    <main class="contenido">
        <h2>Cuestionario</h2>
        <div class="cuestionario">
            <form action="resp-cuestionario.php" method="POST">
                <input type="hidden" name="id_alumno" value=<?php echo $id_alumno ?>>
                <input type="hidden" name="id_grupo" value=<?php echo $id_grupo1 ?>>
                <div id="cat_par">
                    <h3>Estilo de Aprendizaje</h3>
                    <div id="pregunta-bloque">
                        <p>¿Cuál es tu estilo de aprendizaje principal?</p>
                        <label>
                            <input type=radio name="ea" value="V" required>Visual-audiovisual
                        </label>
                        <label>
                            <input type=radio name="ea" value="T">Teórico-Lectura
                        </label>
                        <label>
                            <input type=radio name="ea" value="P">Práctico
                        </label>
                    </div>
                </div>
                <div id="cat_imp">
                    <h3>Hábitos de estudio y en clase</h3>
                    <div id="pregunta-bloque">
                        <p>1. Cuando tienes un examen:</p>
                        <label>
                            <input type=radio name="he_1" value="3" required>Estudias poco a poco desde una semana antes y haces un plan.
                        </label>
                        <label>
                            <input type=radio name="he_1" value="2">Estudias un par de días antes en tu tiempo libre.
                        </label>
                        <label>
                            <input type=radio name="he_1" value="1">Estudias la última noche.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>2. Si vas a estudiar por un largo periodo:</p>
                        <label>
                            <input type=radio name="he_2" value="3" required>Haces esquemas, lo explicas en voz alta con tus propias palabras o realizas ejercicios para probarte.
                        </label>
                        <label>
                            <input type=radio name="he_2" value="2">Intentas memorizar las cosas tal y como están en tus apuntes.
                        </label>
                        <label>
                            <input type=radio name="he_2" value="1">Relees la información y subrayas casi todo.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>3. Si vas a estudiar por un largo periodo:</p>
                        <label>
                            <input type=radio name="he_3" value="3" required>Alternas entre tiempo de estudio enfocado y breves descansos.
                        </label>
                        <label>
                            <input type=radio name="he_3" value="2">Tomas descansos libremente y tiendes a tomar más descansos si no entiendes el tema.
                        </label>
                        <label>
                            <input type=radio name="he_3" value="1">Estudias de corrido sin parar por varias horas.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>4. En clase:</p>
                        <label>
                            <input type=radio name="he_4" value="3" required>Prestas atención y tomas apuntes, y si es necesario los completas.
                        </label>
                        <label>
                            <input type=radio name="he_4" value="2">Tomas pocas notas y tiendes a distraerte cada tanto.
                        </label>
                        <label>
                            <input type=radio name="he_4" value="1">Se te dificulta enfocarte y terminas haciendo otra cosa.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>5. Cuando termina la clase o finalizan un tema, ¿tiendes a practicar y repasarlo más?</p>
                        <label>
                            <input type=radio name="he_5" value="3" required>Sí, para reforzar mis conocimientos.
                        </label>
                        <label>
                            <input type=radio name="he_5" value="2">Sí, porque a veces no comprendo todo.
                        </label>
                        <label>
                            <input type=radio name="he_5" value="1">No me hace falta, con las clases es más que suficiente.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>6. Si no entiendes un tema:</p>
                        <label>
                            <input type=radio name="he_6" value="3" required>Intentas desenredar el problema investigando y preguntando a profesores o alumnos.
                        </label>
                        <label>
                            <input type=radio name="he_6" value="2">Intentas aprenderte los pasos o los conceptos de memoria aunque no los entiendas.
                        </label>
                        <label>
                            <input type=radio name="he_6" value="1">Pasas de tema o cambias a uno más fácil. 
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>7. Cuando un código no funciona en clase, ¿qué decisión tomas?</p>
                        <label>
                            <input type=radio name="he_7" value="3" required>Pido ayuda al maestro o a los asesores.
                        </label>
                        <label>
                            <input type=radio name="he_7" value="2">Prefiero resolverlo solo o en mi casa con más tiempo.
                        </label>
                        <label>
                            <input type=radio name="he_7" value="1">Me doy por vencido y espero a que lo resuelvan o que alguien más me lo pase.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>8. ¿Cómo es el lugar o espacio donde te sientas a estudiar habitualmente?</p>
                        <label>
                            <input type=radio name="he_8" value="3" required>Es un lugar fijo, ordenado, iluminado y libre de distracciones.
                        </label>
                        <label>
                            <input type=radio name="he_8" value="2">Estudio en cualquier sitio disponible, a veces con ruido o la televisión encendida.
                        </label>
                        <label>
                            <input type=radio name="he_8" value="1">No tengo un lugar fijo, suelo estudiar acostado en la cama o en lugares muy ruidosos.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>9. Antes de iniciar una clase, ¿repasas los temas que han visto?</p>
                        <label>
                            <input type=radio name="he_9" value="3" required>Sí, leo mis apuntes o el material disponible para estar listo.
                        </label>
                        <label>
                            <input type=radio name="he_9" value="2">A veces los reviso, solo si no me quedaron claros o conceptos específicos.
                        </label>
                        <label>
                            <input type=radio name="he_9" value="1">No, no lo considero importante.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>10. Para organizarte:</p>
                        <label>
                            <input type=radio name="he_10" value="3" required>Haces uso de una agenda, calendario o app para organizar tareas y proyectos, y los priorizas.
                        </label>
                        <label>
                            <input type=radio name="he_10" value="2">Anotas los pendientes en hojas sueltas, apuntes u otro lugar disperso, o confías en tu memoria.
                        </label>
                        <label>
                            <input type=radio name="he_10" value="1">No anotas nada y terminas preguntando a tus compañeros.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>11. ¿Crees que te estás esforzando para obtener buenas calificaciones?</p>
                        <label>
                            <input type=radio name="he_11" value="3" required>Sí, estoy haciendo mi mejor esfuerzo.
                        </label>
                        <label>
                            <input type=radio name="he_11" value="2">No, aún me falta mejorar.
                        </label>
                        <label>
                            <input type=radio name="he_11" value="1">Más o menos, a veces.
                        </label>
                    </div>
                </div>
                <div id="cat_par">
                    <h3>Tiempo Disponible</h3>
                    <div id="pregunta-bloque">
                        <p>1. ¿Cuánto tiempo podrías dedicar a diario a estudiar para el ETE?</p>
                        <label>
                            <input type=radio name="t_1" value="3" required>2-3 horas
                        </label>
                        <label>
                            <input type=radio name="t_1" value="2">30 minutos a 2 hora
                        </label>
                        <label>
                            <input type=radio name="t_1" value="1">Menos de 30 minutos
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>2. Y en periodo de exámenes</p>
                        <label>
                            <input type=radio name="t_2" value="3" required>1-2 horas
                        </label>
                        <label>
                            <input type=radio name="t_2" value="2">30 minutos a 1 hora
                        </label>
                        <label>
                            <input type=radio name="t_2" value="1">Menos de 30 minutos
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>3. ¿Dirías que tu grupo curricular es pesado (maestros exigentes, muchos trabajos, etc.)? </p>
                        <label>
                            <input type=radio name="t_3" value="3" required>No realmente
                        </label>
                        <label>
                            <input type=radio name="t_3" value="2">Más o menos
                        </label>
                        <label>
                            <input type=radio name="t_3" value="1">Mucho
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>4. ¿Además de la escuela trabajas?</p>
                        <label>
                            <input type=radio name="t_4" value="3" required>No
                        </label>
                        <label>
                            <input type=radio name="t_4" value="2">Si menos de 15 horas a la semana
                        </label>
                        <label>
                            <input type=radio name="t_4" value="1">Si, más de 15 horas a la semana
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>5. ¿Tienes alguna actividad extra (deporte, talleres, cursos)?</p>
                        <label>
                            <input type=radio name="t_5" value="3" required>No 
                        </label>
                        <label>
                            <input type=radio name="t_5" value="2">Si, entre 1 y 5 horas a la semana
                        </label>
                        <label>
                            <input type=radio name="t_5" value="1">Si, más de 5 horas diarias
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>6. Considerando tiempo de transporte, deberes personales y otros compromisos, ¿tienes suficiente tiempo para cumplir con todas tus actividades diarias, incluidas las de la escuela?</p>
                        <label>
                            <input type=radio name="t_6" value="3" required>Si, cuento con el tiempo suficiente al día.
                        </label>
                        <label>
                            <input type=radio name="t_6" value="2">A veces, dependiendo del momento (semana de evaluación, temporada de competencias, época de lluvia).
                        </label>
                        <label>
                            <input type=radio name="t_6" value="1">No, tiendo a no terminar algunas actividades o tengo que sacrificar unas por otras.
                        </label>
                    </div>
                </div>
                <div id="cat_imp">
                    <h3>Análisis y abstracción</h3>
                    <div id="pregunta-bloque">
                        <p>1. Cuando tu código presenta un error:</p>
                        <label>
                            <input type=radio name="aa_1" value="3" required>Revisas el mensaje de error y analizas la lógica del código paso a paso o en la sección que corresponda.
                        </label>
                        <label>
                            <input type=radio name="aa_1" value="2">Intentas buscar el error en internet o con IA para que te dé el código corregido.
                        </label>
                        <label>
                            <input type=radio name="aa_1" value="1">Borras el código completamente o intentas resolverlo modificando cosas al azar.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>2. Cuando explican un nuevo concepto (función, comando, estructura lógica):</p>
                        <label>
                            <input type=radio name="aa_2" value="3" required>Se te facilita entender la lógica y aplicarla a una variedad de problemas.
                        </label>
                        <label>
                            <input type=radio name="aa_2" value="2">Puedes usarla bien mientras el problema se parezca a los ejemplos vistos en clase.
                        </label>
                        <label>
                            <input type=radio name="aa_2" value="1">Te cuesta trabajo entender cómo funciona realmente o necesitas verlo aplicado y funcionando.
                        </label>
                    </div>
                </div>
                <div id="cat_par">
                    <h3>Equipo de cómputo</h3>
                    <div id="pregunta-bloque">
                        <p>1. ¿Cuentas con acceso a un equipo de cómputo?</p>
                        <label>
                            <input type=radio name="ec_1" value="3" required>Si, cuento con equipo propio
                        </label>
                        <label>
                            <input type=radio name="ec_1" value="2">Si, pero es compartido o prestado
                        </label>
                        <label>
                            <input type=radio name="ec_1" value="1">No, solo en la clase
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>2. ¿Tu equipo cuenta con los programas o aplicaciones usadas en clase?</p>
                        <label>
                            <input type=radio name="ec_2" value="3" required>Si, con todos
                        </label>
                        <label>
                            <input type=radio name="ec_2" value="2">Algunos, no todos funcionan o no se pueden instalar
                        </label>
                        <label>
                            <input type=radio name="ec_2" value="1">No los tiene / No tienes equipo
                        </label>
                    </div>
                </div>
                <div id="cat_imp">
                    <h3>Motivación y Entorno de aprendizaje</h3>
                    <div id="pregunta-bloque">
                        <p>1. ¿Cuál dirías que es tu interés actual por la programación?</p>
                        <label>
                            <input type=radio name="mye_1" value="3" required>Alto, me llaman la atención los temas y aprender cómo aplicarlos.
                        </label>
                        <label>
                            <input type=radio name="mye_1" value="2">Medio, se me dificultan algunos temas o no me interesan del todo.
                        </label>
                        <label>
                            <input type=radio name="mye_1" value="1">Bajo, sinceramente creo que la programación podría no ser lo mío.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>2. ¿Consideras que el profesor enseña claramente los temas?</p>
                        <label>
                            <input type=radio name="mye_2" value="3" required>Sí, le entiendo y me agrada el método que lleva.
                        </label>
                        <label>
                            <input type=radio name="mye_2" value="2">A veces, siento que llega a ir muy rápido o los temas no me quedan claros.
                        </label>
                        <label>
                            <input type=radio name="mye_2" value="1">No, siento que no vemos los temas completos o los explica de forma muy vaga.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>3. ¿Te has planteado darte de baja del ETE?</p>
                        <label>
                            <input type=radio name="mye_3" value="3" required>No, para nada.
                        </label>
                        <label>
                            <input type=radio name="mye_3" value="2">A veces, me lo he llegado a plantear.
                        <label>
                            <input type=radio name="mye_3" value="1">Si, definitivamente.
                        </label>
                    </div>
                    <div id="pregunta-bloque">
                        <p>4. ¿Cuál sería el principal motivo por el que lo harías?</p>
                        <label>
                            <input type=radio name="mye_4" value="4" required>No me lo he planteado.
                        </label>
                        <label>
                            <input type=radio name="mye_4" value="3" required>No le estoy entendiendo a los temas.
                        </label>
                        <label>
                            <input type=radio name="mye_4" value="2">Necesito priorizar mis clases curriculares.
                        </label>
                        <label>
                            <input type=radio name="mye_4" value="1">No tiempo.
                        </label>
                    </div>
                    <div class="pregunta-bloque">
                        <p>¿Tienes algún comentario o sugerencia adicional?</p>
                        <textarea name="comentario" rows="4" placeholder="Escribe aquí tus comentarios"></textarea>
                    </div>
                    <div class="contenedor-boton">
                        <button type="submit" class="btn-enviar">Enviar Cuestionario</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
    }
    else{
        header("Location: inicio.php"); 
    }
?>