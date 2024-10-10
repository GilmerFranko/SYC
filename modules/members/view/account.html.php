<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la configuración del perfil del usuario
 *
 */

require Core::view('head', 'core');
?>


<!-- Body -->
<section id="memberAccount" class="">
    <!-- Header -->
    <?php require Core::view('menu', 'core'); ?>
    <!-- / Header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <form action="<?php echo Core::model('extra', 'core')->generateUrl('members', 'account', 'save'); ?>" method="post" enctype="multipart/form-data">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Configuración del Perfil</h2>
                            <div class="accordion" id="accountSettingsAccordion">
                                <!-- Información Personal -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingInfo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo" aria-expanded="true" aria-controls="collapseInfo">
                                            Información Personal
                                        </button>
                                    </h2>
                                    <div id="collapseInfo" class="accordion-collapse collapse show" aria-labelledby="headingInfo" data-bs-parent="#accountSettingsAccordion">
                                        <div class="accordion-body">
                                            <?php include Core::view('account.profile.area'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Seguridad -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecurity">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecurity" aria-expanded="false" aria-controls="collapseSecurity">
                                            Seguridad
                                        </button>
                                    </h2>
                                    <div id="collapseSecurity" class="accordion-collapse collapse" aria-labelledby="headingSecurity" data-bs-parent="#accountSettingsAccordion">
                                        <div class="accordion-body">
                                            <?php include Core::view('account.security.area'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center border-0">
                            <button type="submit" class="btn btn-primary btn-lg" name="saveAccount" id="btnSaveAccount"><i class="bi bi-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- / Body -->

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->