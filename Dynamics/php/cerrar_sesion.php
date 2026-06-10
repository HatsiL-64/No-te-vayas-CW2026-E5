<?php
session_start();


if (isset($_SESSION["usuario"])) {
  session_destroy();
  setcookie("usuario", "", time() - 1);
  header("Location: ../../login.html");
}
else
  header("Location: ../../login.html");