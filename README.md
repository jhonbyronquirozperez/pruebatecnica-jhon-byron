
 ## Prueba tecnica Full stack php-wordpress

 [video previsualización de la solución](https://youtu.be/nYYyq6RPSdM)

0. Ejecuta esta sentencia para la base de datos - la ejecute en el puerto 33065 de xampp con Mysql :
```sql
CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_en_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `cantidad_en_stock`) VALUES
(1, 'jhon', 'hola mundo', 50.00, 2);
```


1. Clona el repositorio:

   ```bash
   git clone https://github.com/jhonbyronquirozperez/pruebatecnica-jhon-byron
   ```

2. Entra en xampp/htdocs y pega la carpeta :

   ```bash
   C:\xampp\htdocs\Prueba técnica analista desarrollador full stack JHON BYRON QUIROZ
   ```
   

###  **Uso**
- Ejemplos de cómo usar la aplicación. Incluir capturas de pantalla, comandos o videos explicativos.

```markdown
## archivos

Una vez que la aplicación está en funcionamiento, accede a `http://localhost` para ver la interfaz de usuario.
en caso tal que necesites el puerto , recuerda que lo ejecute en el 33065 por lo que quedaria `http://localhost:33065`