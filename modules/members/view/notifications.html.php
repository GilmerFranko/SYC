<?php defined('SYC') || exit;

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<!-- Body -->
<section id="viewNotifications">
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Notificaciones</div>
  <ul class="collection">
    <?php
    if (!empty($notifications))
    {
      foreach ($notifications as $notification)
      {
        echo '<li class="collection-item avatar" style="' . ($notification['read_time'] > 0 ? 'background: #202123;' : 'light-black') . ' border:none;" id="not' . $notification['id'] . '">
      <a href="">
        <img src="' . $config['avatar_url'] . DS . Core::model('member', 'members')->getAvatar($notification['from_member']) . '" alt="Avatar" class="circle">
        </a>
        <span class="title">' . (empty($notification['content']) ? Core::model('notifications', 'members')->generateNotification($notification['to_member'], $notification['from_member'], $notification['not_key'], $notification['item_id'], $notification['subitem_id']) : $notification['content']) . '</span>
      <span class="secondary-content">' . Core::model('date', 'core')->getTimeAgo($notification['sent_time']) . '<i class="material-icons right">date_range</i></span>
      <!--<span class="secondary-content">' . date('d-m-y H:i', $notification['sent_time']) . '<i class="material-icons right">date_range</i></span>-->
    </li>';
      }
    }
    else
    {
      echo '<blockquote class="flow-text">No hay notificaciones</blockquote>';
    }
    ?>
  </ul>
</section>
<!-- / Body -->

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->