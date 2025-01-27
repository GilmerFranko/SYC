<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página para enviar nuevo mensaje
 *
 */

require Core::view('head', 'core');

?>
<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section class="first-section">

  <div class="container">
    <div class="row">
      <div class="col col-12">
        <div class="card">
          <div class="card-header">
            Buzón de Mensajes
          </div>
          <div class="card-body">
            <div id="messages-container">
              <?php if (($messages and $messages['rows'] > 0)) : ?>
                <?php foreach ($messages['data'] as $message) : ?>
                  <div class="message-item d-flex align-items-start mb-3">
                    <div class="profile-picture">
                      <img src="<?= $config['avatar_url'] . DS . ($message['opposite_member_photo']); ?>" alt="Profile Picture" class="img-fluid rounded-circle">
                    </div>
                    <div class="message-content ms-3">
                      <div class="d-flex justify-content-between">
                        <span class="name"><?php echo htmlspecialchars($message['opposite_member_name']); ?></span>
                        <div>
                          <span class="date"><?php echo loadClass('core/date')->getFormattedDate($message['sent_at']); ?></span>
                          <?php if ($message['is_read'] == 0 and $message['from_member_id'] != $m_id) : ?>
                            <span class="" style="background: red; color: white; padding: 2px 4px; border-radius: 4px;font-size: small">Nuevo</span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <p class="content"><?php echo htmlspecialchars(($message['from_member_id'] != $m_id) ? $message['opposite_member_name'] . ': ' . $message['content'] : 'Tu: ' . $message['content']); ?></p>
                      <a href="<?= gLink('members/view.messages', ['r_id' => $message['opposite_member_id']]) ?>" class="btn btn-sm btn-primary">Ver Mensaje</a>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <p>No hay mensajes en tu buzón.</p>
              <?php endif; ?>
            </div>
          </div>
          <?php if (($messages and $messages['rows'] > 0)) : ?>
            <div class="footer">
              <?= $messages['pages']['paginator']; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .message-item {
    border-bottom: 1px solid #ddd;
    padding: 10px;
  }

  .profile-picture img {
    width: 50px;
    height: 50px;
    object-fit: cover;
  }

  .message-content {
    flex: 1;
  }

  .name {
    font-weight: bold;
  }

  .date {
    color: #888;
    font-size: 0.9rem;
  }

  .content {
    margin-top: 5px;
    word-wrap: break-word;
  }

  @media (max-width: 576px) {
    .message-item {
      flex-direction: column;
      align-items: flex-start;
    }

    .profile-picture {
      margin-bottom: 10px;
    }
  }
</style>