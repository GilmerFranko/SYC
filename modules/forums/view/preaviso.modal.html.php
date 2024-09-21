<div id="antiSpam" class="" style="display: none;">
  <div class="card-content">
    <div style="text-align:center;display:block">
      <a href="#" class="text-secondary" onclick="document.querySelector('.preAviso0').style.display = 'block'; document.querySelector('.preAviso').remove();"><strong>ENTRAR</strong></a>
      <br>
      <span style="color:var(--bs-gray-800);">(supone la aceptación de las siguientes condiciones)</span>

    </div>
    <div style="color: var(--bs-gray-800);padding: 0 160px;">
      <br>
      <br>
      Soy <strong>mayor de edad</strong> y soy consciente de que en esta sección se puede mostrar <strong>Contenido para adultos</strong>.
      <br>
      <br>
      1- Soy adulto entendiéndose como tal a mayor de 18 años (o la edad legal en mi país de residencia).
      <br>
      <br>
      2- Estoy de acuerdo en ver este tipo de material para adultos y no utilizarlo con fines comerciales.
      <br>
      <br>
      3- Declaro que la visualización de material e imágenes para adultos no está prohibido ni infringe ninguna ley en la comunidad donde resido, ni de mi proveedor de servicios o el local desde donde accedo.
      <br>
      <br>
      4- No exhibiré este material a menores o a cualquier otra persona que pueda resultar ofendida o que no cumpla con estas condiciones.
    </div>
  </div>
</div>

<script>
  // Cargar contenido de #antiSpam en .preAviso al cargar la pagina
  $(document).ready(function() {
    $('.preAviso').html($('#antiSpam').html());
  });
</script>