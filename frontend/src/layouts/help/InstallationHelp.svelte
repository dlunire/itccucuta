<section class="help">
    <h3 class="help__title">
        🗂️ Panel de configuración de credenciales de base de datos
    </h3>

    <p>
        Este formulario permite ingresar las credenciales necesarias para
        establecer una conexión con un motor de base de datos. A través de esta
        interfaz, el usuario puede definir los parámetros de conexión,
        codificación y comportamiento de sesión, lo que facilita la
        interoperabilidad con distintos sistemas de gestión de bases de datos
        (SGBD).
    </p>

    <h4 class="help__title">Campos disponibles:</h4>
    <ul class="help__list">
        <li class="help__item">
            <strong>Seleccione una opción:</strong> Menú desplegable para elegir
            una operación o tipo de conexión (por definir según la lógica del sistema).
        </li>
        <li class="help__item">
            <strong>Contraseña de la BD:</strong> Campo seguro para ingresar la clave
            de acceso del usuario autenticado.
        </li>
        <li class="help__item">
            <strong>Tiempo de vida:</strong> Define la duración (en segundos) de
            la sesión o token de acceso. Por defecto, se establece en
            <code>3600</code> segundos (1 hora).
        </li>
        <li class="help__item">
            <strong>Nombre del host:</strong> Dirección del servidor donde
            reside la base de datos. Ejemplo: <code>localhost</code> o una IP remota.
        </li>
        <li class="help__item">
            <strong>N.º de puerto:</strong> Puerto de conexión correspondiente
            al motor. Ejemplo: <code>3306</code> para MySQL/MariaDB.
        </li>
        <li class="help__item">
            <strong>Usuario de la BD:</strong> Nombre de usuario autorizado para
            acceder a la base de datos.
        </li>
        <li class="help__item">
            <strong>Nombre de la BD:</strong> Identificador de la base de datos a
            la cual se desea conectar.
        </li>
        <li class="help__item">
            <strong>Codificación:</strong> Charset utilizado en la comunicación
            con la base de datos (por defecto <code>utf8</code>).
        </li>
        <li class="help__item">
            <strong>Colación:</strong> Define el tipo de ordenamiento y
            comparación de texto (por defecto <code>utf8_general_ci</code>).
        </li>
        <li class="help__item">
            <strong>Motor de BD:</strong> Tipo de motor de base de datos
            soportado. Ejemplos válidos: <code>mysql</code>,
            <code>mariadb</code>, <code>sqlite</code>, <code>postgresql</code>.
        </li>
    </ul>

    <h4>Botón de acción:</h4>
    <ul>
        <li>
            <strong>Establecer credenciales:</strong> Envía el formulario y aplica
            la configuración de conexión para futuras operaciones con el sistema.
        </li>
    </ul>
</section>
