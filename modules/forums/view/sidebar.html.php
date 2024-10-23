<?php

/* Optiene los foros mas visitados */
$f_most_visited = loadClass('forums/locations')->getMostVisitedLocations($limit = 50);

?>

<div class="container">
  <div class="menu-sidebar1 row">
    <!-- Item 1 -->
    <div class="meca">
      MENÚ
    </div>
    <div class="item-menu-sidebar">
      <img src="<?= gImage('home-design.png') ?>" alt="Imagen 1">
      <div class="item-text"><a href="<?= gLink() ?>">PÁGINA<br>PRINCIPAL</a></div>
    </div>

    <!-- Item 2 -->
    <div class="item-menu-sidebar">
      <img src="https://nuevapasion.com/images/ico-public-advertisements.png" alt="Imagen 2">
      <div class="item-text"><a href="<?= gLink('mi-panel/publicar') ?>">PUBLICAR<br>ANUNCIOS</a></div>
    </div>

    <!-- Item 3 -->
    <div class="item-menu-sidebar">
      <img src="https://nuevapasion.com/images/edit-advertisements.png" alt="Imagen 3">
      <div class="item-text"><a href="<?= gLink('mi-panel/anuncios') ?>">MODIFICAR <br>MIS ANUNCIOS</a></div>
    </div>

    <!-- Item 4 -->
    <div class="item-menu-sidebar">
      <img src="https://nuevapasion.com/images/fav-advertisements.png" alt="Imagen 4">
      <div class="item-text"><a href="<?= gLink('mi-panel/favoritos') ?>">MI SELECCION <br>DE ANUNCIOS</a></div>
    </div>

    <div class="item-menu-sidebar">
      <img src="<?= $config['images_url'] ?>/contactus.png" alt="Imagen 4">
      <div class="item-text"><a href="<?= gLink('site/contact') ?>">CONTACTAR CON<br> NUESTRO EQUIPO</a></div>
    </div>
  </div>

  <?php
  $locations_in = loadClass('forums/locations')->getTop10LocationsWithMostThreads();
  usort($locations_in, function ($a, $b)
  {
    return strcmp($b['contact_name'], $a['contact_name']);
  });
  ?>
  <!-- LAS 10 PROVINCIAS CON MAS ANUNCIOS -->
  <div class="menu-sidebar1 row">
    <!-- Item 1 -->
    <div class="meca">
      CON MÁS ANUNCIOS
    </div>
    <?php foreach ($locations_in as $location_in)
    { ?>
      <div class="item-menu-sidebar <?= ($location_in['short_url'] == $location_url) ? 'item-menu-sidebar-active' : '' ?>">
        <a class="item-text" href="<?= gLink('f/' . $location_in['short_url']) ?>"><strong><?= strtoupper($location_in['contact_name'] . ' EN ' . $location_in['name']) ?></strong></a>
      </div>
    <?php } ?>
  </div>

  <!-- MAPA -->
  <div class="menu-sidebar1 row">
    <div class="center-align">
      <div class="w-auto order-md-2 d-flex flex-row justify-content-center mt-2">
        <div class="map-container">
          <div class="map">
            <img src="https://nuevapasion.com/images/mapa-np.png" height="129" width="136" id="mapa" usemap="#mapa" style="cursor:crosshair; display: block;">
            <map name="mapa">
              <area rel="nofollow" onmouseover="cn('Álava');" shape="POLY" coords="73,14,69,12,65,10,63,11,65,13,63,14,66,17,72,19" alt="Anuncios en Vitoria-Álava" href="<?= gLink('region/alava') ?>">
              <area rel="nofollow" onmouseover="cn('Albacete');" shape="POLY" coords="74,83,88,71,89,73,90,71,84,64,70,65,71,76" alt="Anuncios en Albacete" href="<?= gLink('region/albacete') ?>">
              <area rel="nofollow" onmouseover="cn('Alicante');" shape="POLY" coords="92,87,104,72,99,69,88,74,90,82" alt="Anuncios en Alicante" href="<?= gLink('region/alicante') ?>">
              <area rel="nofollow" onmouseover="cn('Almería');" shape="POLY" coords="67,104,76,86,85,95,78,105" alt="Anuncios en Almería" href="<?= gLink('region/almeria') ?>">
              <area rel="nofollow" onmouseover="cn('Asturias');" shape="POLY" coords="29,14,31,12,45,11,50,7,45,3,24,3,25,13" alt="Anuncios en Asturias" href="<?= gLink('region/asturias') ?>">
              <area rel="nofollow" onmouseover="cn('Ávila');" shape="POLY" coords="40,53,50,50,54,46,48,39,44,39,37,50" alt="Anuncios en Ávila" href="<?= gLink('region/avila') ?>">
              <area rel="nofollow" onmouseover="cn('Badajoz');" shape="POLY" coords="38,84,19,83,20,64,48,68" alt="Anuncios en Badajoz" href="<?= gLink('region/badajoz') ?>">
              <area rel="nofollow" onmouseover="cn('Baleares');" shape="POLY" coords="107,66,132,44,136,55,112,77" alt="Anuncios en Baleares" href="<?= gLink('region/baleares') ?>">
              <area rel="nofollow" onmouseover="cn('Barcelona');" shape="POLY" coords="128,27,115,18,112,28,117,36" alt="Anuncios en Barcelona" href="<?= gLink('region/barcelona') ?>">
              <area rel="nofollow" onmouseover="cn('Burgos');" shape="POLY" coords="54,25,57,37,61,37,66,31,66,22,63,19,65,18,60,15,55,18,57,20" alt="Anuncios en Burgos" href="<?= gLink('region/burgos') ?>">
              <area rel="nofollow" onmouseover="cn('Cáceres');" shape="POLY" coords="16,64,46,68,39,49,25,49" alt="Anuncios en Cáceres" href="<?= gLink('region/caceres') ?>">
              <area rel="nofollow" onmouseover="cn('Cádiz');" shape="POLY" coords="35,116,27,101,49,96,37,108,42,110" alt="Anuncios en Cádiz" href="<?= gLink('region/cadiz') ?>">
              <area rel="nofollow" onmouseover="cn('Cantabria');" shape="POLY" coords="55,16,47,11,47,10,50,5,59,5,65,7,55,13" alt="Anuncios en Cantabria" href="<?= gLink('region/cantabria') ?>">
              <area rel="nofollow" onmouseover="cn('Castellón');" shape="POLY" coords="99,42,89,54,98,57,105,45" alt="Anuncios en Castellón" href="<?= gLink('region/castellon') ?>">
              <area rel="nofollow" onmouseover="cn('Ceuta');" shape="POLY" coords="37,118,44,112,45,122" alt="Anuncios en Ceuta" href="<?= gLink('region/ceuta') ?>">
              <area rel="nofollow" onmouseover="cn('Ciudad Real');" shape="POLY" coords="53,80,70,75,69,63,49,63,45,74" alt="Anuncios en Ciudad Real" href="<?= gLink('region/ciudad-real') ?>">
              <area rel="nofollow" onmouseover="cn('Córdoba');" shape="POLY" coords="49,95,39,83,45,75,53,79,54,95" alt="Anuncios en Córdoba" href="<?= gLink('region/cordoba') ?>">
              <area rel="nofollow" onmouseover="cn('Cuenca');" shape="POLY" coords="69,65,84,63,86,52,75,43,65,52" alt="Anuncios en Cuenca" href="<?= gLink('region/cuenca') ?>">
              <area rel="nofollow" onmouseover="cn('Girona');" shape="POLY" coords="129,28,115,16,134,14" alt="Anuncios en Girona" href="<?= gLink('region/girona') ?>">
              <area rel="nofollow" onmouseover="cn('Granada');" shape="POLY" coords="61,106,54,96,75,84,76,87,66,104" alt="Anuncios en Granada" href="<?= gLink('region/granada') ?>">
              <area rel="nofollow" onmouseover="cn('Guadalajara');" shape="POLY" coords="65,52,61,37,64,35,72,38,79,38,82,44,79,46,75,43" alt="Anuncios en Guadalajara" href="<?= gLink('region/guadalajara') ?>">
              <area rel="nofollow" onmouseover="cn('Guipúzcoa');" shape="POLY" coords="73,14,81,6,72,6,70,12" alt="Anuncios en Guipúzcoa" href="<?= gLink('region/guipuzcoa') ?>">
              <area rel="nofollow" onmouseover="cn('Huelva');" shape="POLY" coords="29,101,32,85,19,83,16,96" alt="Anuncios en Huelva" href="<?= gLink('region/huelva') ?>">
              <area rel="nofollow" onmouseover="cn('Huesca');" shape="POLY" coords="102,32,104,13,90,12,87,15,90,25,98,32" alt="Anuncios en Huesca" href="<?= gLink('region/huesca') ?>">
              <area rel="nofollow" onmouseover="cn('Jaén');" shape="POLY" coords="54,96,73,84,71,75,54,78" alt="Anuncios en Jaén" href="<?= gLink('region/jaen') ?>">
              <area rel="nofollow" onmouseover="cn('A Coruña');" shape="POLY" coords="14,13,18,0,0,8,4,19,7,15" alt="Anuncios en La Coruña" href="<?= gLink('region/a-coruna') ?>">
              <area rel="nofollow" onmouseover="cn('La Rioja');" shape="POLY" coords="78,26,68,24,66,26,66,17,79,22" alt="Anuncios en La Rioja" href="<?= gLink('region/la-rioja') ?>">
              <area rel="nofollow" onmouseover="cn('Las Palmas');" shape="POLY" coords="101,128,113,106,136,106,135,128" alt="Anuncios en Las Palmas" href="<?= gLink('region/las-palmas') ?>">
              <area rel="nofollow" onmouseover="cn('León');" shape="POLY" coords="43,24,26,22,25,17,26,14,29,15,32,13,47,11" alt="Anuncios en León" href="<?= gLink('region/leon') ?>">
              <area rel="nofollow" onmouseover="cn('Lerida');" shape="POLY" coords="103,33,113,28,116,15,105,11" alt="Anuncios en Lerida" href="<?= gLink('region/lleida') ?>">
              <area rel="nofollow" onmouseover="cn('Lugo');" shape="POLY" coords="23,19,22,20,15,18,15,13,18,2,23,4,25,13" alt="Anuncios en Lugo" href="<?= gLink('region/lugo') ?>">
              <area rel="nofollow" onmouseover="cn('Madrid');" shape="POLY" coords="50,50,65,53,60,40" alt="Anuncios en Madrid" href="<?= gLink('region/madrid') ?>">
              <area rel="nofollow" onmouseover="cn('Málaga');" shape="POLY" coords="41,110,38,107,49,96,53,96,59,104" alt="Anuncios en Málaga" href="<?= gLink('region/malaga') ?>">
              <area rel="nofollow" onmouseover="cn('Melilla');" shape="POLY" coords="68,119,62,128,72,128" alt="Anuncios en Melilla" href="<?= gLink('region/melilla') ?>">
              <area rel="nofollow" onmouseover="cn('Murcia');" shape="POLY" coords="84,95,74,83,89,71,90,84,96,91" alt="Anuncios en Murcia" href="<?= gLink('region/murcia') ?>">
              <area rel="nofollow" onmouseover="cn('Navarra');" shape="POLY" coords="80,22,72,18,73,15,80,7,89,12,83,20,83,25,81,27,79,25" alt="Anuncios en Navarra" href="<?= gLink('region/navarra') ?>">
              <area rel="nofollow" onmouseover="cn('Ourense');" shape="POLY" coords="23,28,12,27,13,24,11,21,12,18,16,19,22,21,25,19,26,23,25,25" alt="Anuncios en Ourense" href="<?= gLink('region/ourense') ?>">
              <area rel="nofollow" onmouseover="cn('Palencia');" shape="POLY" coords="45,22,47,12,55,16,53,20,56,28,47,27" alt="Anuncios en Palencia" href="<?= gLink('region/palencia') ?>">
              <area rel="nofollow" onmouseover="cn('Pontevedra');" shape="POLY" coords="12,23,5,27,5,19,7,15,14,14,15,18,11,18,10,21" alt="Anuncios en Pontevedra" href="<?= gLink('region/pontevedra') ?>">
              <area rel="nofollow" onmouseover="cn('Salamanca');" shape="POLY" coords="36,49,25,49,25,38,30,36,44,38" alt="Anuncios en Salamanca" href="<?= gLink('region/salamanca') ?>">
              <area rel="nofollow" onmouseover="cn('Segovia');" shape="POLY" coords="54,44,48,37,56,32,61,32,63,34" alt="Anuncios en Segovia" href="<?= gLink('region/segovia') ?>">
              <area rel="nofollow" onmouseover="cn('Sevilla');" shape="POLY" coords="30,101,33,85,39,84,48,96" alt="Anuncios en Sevilla" href="<?= gLink('region/sevilla') ?>">
              <area rel="nofollow" onmouseover="cn('Soria');" shape="POLY" coords="77,37,64,35,62,32,69,24,78,26" alt="Anuncios en Soria" href="<?= gLink('region/soria') ?>">
              <area rel="nofollow" onmouseover="cn('Tarragona');" shape="POLY" coords="99,41,105,45,116,34,113,29,102,34" alt="Anuncios en Tarragona" href="<?= gLink('region/tarragona') ?>">
              <area rel="nofollow" onmouseover="cn('Tenerife');" shape="POLY" coords="77,128,96,128,107,109,80,109,75,115" alt="Anuncios en Tenerife" href="<?= gLink('region/tenerife') ?>">
              <area rel="nofollow" onmouseover="cn('Teruel');" shape="POLY" coords="89,53,101,38,92,35,91,37,81,39,83,45,80,47" alt="Anuncios en Teruel" href="<?= gLink('region/teruel') ?>">
              <area rel="nofollow" onmouseover="cn('Toledo');" shape="POLY" coords="68,62,43,64,39,52,50,50,65,53" alt="Anuncios en Toledo" href="<?= gLink('region/toledo') ?>">
              <area rel="nofollow" onmouseover="cn('Valencia');" shape="POLY" coords="99,70,97,58,86,54,84,63,90,72" alt="Anuncios en Valencia" href="<?= gLink('region/valencia') ?>">
              <area rel="nofollow" onmouseover="cn('Valladolid');" shape="POLY" coords="47,38,42,37,42,24,45,23,46,27,55,29,56,31" alt="Anuncios en Valladolid" href="<?= gLink('region/valladolid') ?>">
              <area rel="nofollow" onmouseover="cn('Vizcaya');" shape="POLY" coords="63,11,61,10,66,4,71,7,69,12,65,10" alt="Anuncios en Bilbao-Vizcaya" href="<?= gLink('region/vizcaya') ?>">
              <area rel="nofollow" onmouseover="cn('Zamora');" shape="POLY" coords="41,37,30,36,25,26,26,23,42,24" alt="Anuncios en Zamora" href="<?= gLink('region/zamora') ?>">
              <area rel="nofollow" onmouseover="cn('Zaragoza');" shape="POLY" coords="81,39,77,38,78,25,81,27,84,24,83,20,87,15,89,25,98,33,103,33,101,37,92,34,90,37,85,37" alt="Anuncios en Zaragoza" href="<?= gLink('region/zaragoza') ?>">
            </map>

            <input class="text-under-map d-none d-md-block" type="Text" value="" disabled="" name="pr" id="pr">
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  // Si la sección es 'view.searches'
  if ($sSection == 'view.searches')
  {
    $contacts_in = loadClass('forums/f_contacts')->getAllContacts();
  ?>
    <!-- CONTACTOS -->
    <div class="menu-sidebar1 row">
      <!-- Item 1 -->
      <div class="meca">
        MENÚ
      </div>
      <?php foreach ($contacts_in['data'] as $contact_in)
      { ?>
        <div class="item-menu-sidebar <?= ($contact_in['id'] == $contact_id) ? 'item-menu-sidebar-active' : '' ?>">
          <a class="item-text" href="<?= gLink('forums/view.searches', ['contact_id' => $contact_in['id']]) ?>"><strong><?= $contact_in['name'] ?></strong></a>
        </div>
      <?php } ?>
    </div>

  <?php }
  // Si la sección es 'view.threads'
  elseif ($sSection == 'view.threads')
  {
    $locations_in = loadClass('forums/locations')->getLocationsByContactId($contact['id']);
  ?>
    <!-- CONTACTOS -->
    <div class="menu-sidebar1 row">
      <!-- Item 1 -->
      <div class="meca">
        MENÚ
      </div>
      <?php foreach ($locations_in['data'] as $location_in)
      { ?>
        <div class="item-menu-sidebar <?= ($location_in['short_url'] == $location_url) ? 'item-menu-sidebar-active' : '' ?>">
          <a class="item-text" href="<?= gLink('f/' . $location_in['short_url']) ?>"><strong><?= strtoupper($contact['name'] . ' EN ' . $location_in['name']) ?></strong></a>
        </div>
      <?php } ?>
    </div>

  <?php } ?>

  <!-- LO MAS BUSCADO -->
  <!--<div class="menu-sidebar1 row">
    <div class="meca">
      LO MÁS BUSCADO
    </div>
    <?php /*foreach ($f_most_visited['data']  as $i  => $forum_mv): ?>
      <div class="item-menu-sidebar">
        <div class="item-text"><a href="<?= gLink('f/' . $forum_mv['short_url']) ?>"><span class="text-success"><?= ($i + 1) ?></span>. <?= ucfirst(strtolower($forum_mv['contact_name'])) . ' en ' . $forum_mv['name'] ?></a></div>
      </div>
    <?php endforeach; */ ?>
  </div>-->

</div>



<script type="text/javascript">
  function cn(nombre) {
    document.getElementById('pr').value = nombre;
  }
</script>