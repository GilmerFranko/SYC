<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="modal fade" id="statsModal" tabindex="-1" aria-labelledby="statsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statsModalLabel">Estadísticas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="pagAnuStatsAnuBox" style="display: flex;flex-wrap: wrap;">
          <div class="pagAnuStatsAnu">
            <div class="stats">
              Estadísticas
            </div>
            <div class="dato"><strong id="sViewsCount"></strong>
              veces listado
              <a href="javascript:alert('Veces listado es el número de veces que se ha mostrado el anuncio a los usuarios, bien sea en el listado de resultados como en la página propia del anuncio. Solo se cuenta una vez por usuario y este debe estar logueado');"><b>?</b></a>
            </div>
            <div class="dato"><strong id="sCountFavorites"></strong> añadido a favoritos
              <a href="javascript:alert('Añadido a favoritos es el número de usuarios que han añadido este anuncio a su lista de \'Mi selección de anuncios\'.');"><b>?</b></a>
            </div>
            <div class="dato"><strong id="sCountAutorenew"></strong> <a href="/web/20171209172108/http://www.pasion.com/creditos/auto-renueva.php">auto·renovados</a></div>
          </div>

          <div class="pagAnuGraph">
            <div id="chart_div_modal_modal"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  visits = [];

  function openStatsModal(thread_id) {

    $.ajax({
      url: '<?= gLink('forums/threads.actions') ?>',
      type: 'POST',
      data: {
        'do': 'stats',
        'thread_id': thread_id,
        'ajax': true
      },
      success: function(data) {
        var obj = JSON.parse(data);
        $('#sViewsCount').html(obj.views_count);
        $('#sCountFavorites').html(obj.count_favorites);
        $('#sCountAutorenew').html(obj.count_autorenew);
        visits = obj.visits;

        console.log(visits);
        // Crea el grafico
        google.charts.load('current', {
          packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart1);

        // Muesta modal
        var myModal = new bootstrap.Modal(document.getElementById('statsModal'));
        myModal.show();
        $('#thread_id_stats').val(thread_id);
      }
    });
  }

  function drawChart1() {
    // Crea el array de datos con la estructura adecuada
    var data = google.visualization.arrayToDataTable([
      ['Fecha', 'Veces listado'], // Encabezado de las columnas
      ...visits.map(function(visit) { // Mapea las visitas en el formato que necesita Google Charts
        return [visit[0], visit[1]]; // Para cada visita, crea un array con [Fecha, Veces listado]
      })
    ]);
    // Opciones del gráfico
    var options = {
      title: 'Veces listado por día',
      hAxis: {
        title: 'Ultimos 10',
        titleTextStyle: {
          color: '#333'
        },
        textPosition: 'none', // Título del eje en la parte superior
      },
      vAxis: {
        minValue: 0,
        gridlines: {
          count: 5 // Controla cuántas líneas de grilla quieres
        }
      },
      height: 200,
      width: 250,
      backgroundColor: '#f8fff8',
      colors: ['068306'],

      chartArea: {
        left: '40',
        width: '200',
        top: '15'
      }
    };

    // Dibuja el gráfico en el div con id 'chart_div_modal_modal'
    var chart = new google.visualization.AreaChart(document.getElementById('chart_div_modal_modal'));
    chart.draw(data, options);
  }
</script>