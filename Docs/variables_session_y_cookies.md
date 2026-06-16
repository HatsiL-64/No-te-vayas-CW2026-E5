## Variable $_SESSION y $_COOKIES

### $_SESSION
Guarda: usuario, tipo_usuario y nombre.  
  
- Usuario: id_usuario, numero INT
- tipo_usuario: tipo_usuario, char [1-3]
- nombre: nombre, varchar
- llave: entero en el intervalo [1, 72057594037927935]

### $_COOKIES
  
- usuario: identificador del usuario cifrado por 604800s (1 semana)