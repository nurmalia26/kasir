</section>
</div>
<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?></strong> | <?= APP_NAME; ?>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> <?= APP_VERSION; ?>
    </div>
</footer>

</div>


<!-- jQuery -->
<script src="<?= APP_URL; ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= APP_URL; ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- jquery-validation -->
<script src="<?= APP_URL; ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= APP_URL; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- JQVMap -->
<script src="<?= APP_URL; ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= APP_URL; ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- moment -->
<script src="<?= APP_URL; ?>/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= APP_URL; ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= APP_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Summernote -->
<script src="<?= APP_URL; ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= APP_URL; ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= APP_URL; ?>/dist/js/adminlte.js"></script>
<!-- Select2 -->
<script src="<?= APP_URL; ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- Sweetalart -->
<script src="<?= APP_URL; ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- DataTables -->
<script src="<?= APP_URL; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= APP_URL; ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Custom Javascript -->
<script src="<?= APP_URL; ?>/js/script.js"></script>

<?php Flasher::flash() ?>
</body>

</html>