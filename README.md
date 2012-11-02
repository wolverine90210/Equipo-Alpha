Registro de concursos de programación

Se encuentra la problemática de que continuamente se crean corcursos de programación para mantener a la comunidad actualizada, y es díficil informar a los usuarios y hacerlos participes, por esto es que se busca un sistema donde los usuarios den de alta los concursos y las entradas a cada uno de ellos.

Todos los concursos registrados en el sistema deben poder ser consultados por medio de un canal de RSS, para poder ser agregado en un lector de RSS y otros sistemas de automatizado.

Cualquier persona al ingresar al sitio podrá ver por medio de un calendario -con distintas vistas que son por fechas de cierre y categorias- los concursos registrados, y sobre todo, tendrá acceso a un botón permanente en todas las vistas para dar de alta nuevos concursos.

Si un usuario da clic en ese botón, por medio del sistema de login de Twitter podrá registrar un nuevo concurso y automáticamente será agregado a la base de datos del sistema.

Igualmente, cualquier usuario loggeado por medio de Disqus podrá agregar comentarios a los eventos registrados.

Un usuario que previamente ha registrado concursos de programación (es decir que ya esta registrado en la base de datos) tendrá de manera permanente un botón con acceso a su cuenta, donde podrá listar sus eventos clasificados por aquellos que ya han sido aceptados por los administradores, aquellos que han sido rechazados, así como aquellos que están pendientes de evaluación. Igualmente podrá ver quienes han ganado concursos previos así como los “arrobas” de los usuarios que enviaron entradas. Las acciones a realizar con estos concursos de programación será edición y eliminación.

Los concursos de programación tienen un hashtag que se utilizará para la publicación del mismo y sus entradas.

El administrador (el cual es dado de alta directamente en la base de datos) podrá aceptar concursos de programación, cancelarlos -si lo desea, agregará mensaje del motivo-, y editarlos.

Tanto el usuario registrado como el administrador podrán obtener archivos con listados de eventos, o eventos individuales en formatos XLS y/o PDF.

Cuando un usuario desee agregar entradas para un concurso en específico agregará el link donde haya hospedado su código y un comentario. De esta manera se generará un tweet con la información del concurso, el comentario, el usuario y su enlace a la entrada.

Datos a guardar de los concursos:
+ Nombre del concurso
+ Imagenes (una o varias imagenes y redimensionar estas a máximo 500px, las cuales no se relacionan al evento pero solo se muestran en los casos en los que los usuarios lo pongan por medio del editor de texto libre)
+ Texto libre (puede incluir tags html)
+ Categoria (lenguajes) pero el administrador por medio de una sección de administración debe poder dar de alta mas categorías. La categoría “abierto” debe existir para los concursos que acepten cualquier lenguaje de programación
+ Hashtag (para las publicaciones en twitter)
+ Dificultad (básico, intermedio, avanzado)
+ Quien agrega el evento (que es la imágen del usuario en twitter y su arroba)
+ Fecha de inicio (la cual solo puede ser una fecha superior a la fecha en que se crea el evento, y esta genera una regla para que cuando el evento sea aceptado por los administradores, no deberá aparecer en línea a menos que la fecha sea actual)
+ Fecha de finalización (la cual será la única fecha en la que los usuarios podran dar de alta nuevas entradas.).
+ Fecha de creación (la cual no se muestra cuando el evento se publica, pero sirve al administrador para situaciones de BI).

Plugins y configuraciones extras serán tomadas en cuentapara mejores en calificación
+ Rewrite en Apache para la url de los eventos con el id del concuros, title del mismo y su fecha
+ Manejar distintos colores a las categorías de concursos en la vista de calendario
+ Crear la conexión de MySQL hacia la librería de calendario como un WebService
+ Utilizar diseños responsivos

Notas de programación
El manejo de las vistas de calendario se hace por medio de una librería de jQuery
Para conectar esa librería con los datos de la base de datos se hace por medio de JSON
Para el manejo de comentarios se utiliza el recurso Disqus
Para que los usuarios almacenen su código se usa codepad.org

