</div>
    </div>

   






<!-- Footer Api uselessfacts -->
<footer class="bg-body-tertiary text-center text-lg-start">

  
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    <div id="fact">
            Cargando un hecho interesante...
    </div>
     <br>

    <a class="text-body" href="https://byroncodes.co/">Por: Byron © 2024</a>
  </div>
</footer>
<!-- Footer Api uselessfacts -->




<!-- Scripts -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    // Solicitud para obtener un hecho aleatorio en inglés y mostrarlo en el footer
    fetch('https://uselessfacts.jsph.pl/api/v2/facts/today?language=en', {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }
        return response.json(); // Convertir la respuesta a JSON
    })
    .then(data => {
        document.getElementById('fact').textContent = `Hecho del día!!!: ${data.text}`;
    })
    .catch(error => {
        document.getElementById('fact').textContent = 'Hubo un problema al cargar el hecho.';
        console.error('Hubo un problema con la solicitud:', error);
    });





    // Realizar la solicitud a la API para obtener dos hechos sobre gatos 
    fetch('https://meowfacts.herokuapp.com/?count=2&lang=esp')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.statusText);
                }
                return response.json();  
            })
            .then(data => {
                // Unir los hechos en un solo mensaje
                const catFacts = data.data.join('\n\n');
                // Mostrar la ventana emergente con los datos sobre gatos
                swal('Sabías que...\n\n ?' , catFacts);
            })
            .catch(error => {
                console.error('Hubo un problema con la solicitud:', error);
            });




    


</script>



</body>
</html>