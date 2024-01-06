</div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme d-none-print">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                <?= date('Y') ?> © made with ❤️ by
                                <a href="https://dolanakode.web.id" target="_blank" class="footer-link fw-medium">Dolanankode</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade  d-none-print"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle  d-none-print"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?= $config['base']['url'] ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= $config['base']['url'] ?>/assets/vendor/libs/select2/select2.min.js"></script>
    <script src="<?= $config['base']['url'] ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= $config['base']['url'] ?>/assets/vendor/js/bootstrap.js"></script>
    {{-- <script src="<?= $config['base']['url'] ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script> --}}
    <script src="<?= $config['base']['url'] ?>/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= $config['base']['url'] ?>/assets/js/main.js"></script>

    <!-- Page JS -->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="<?= $config['base']['url'] ?>/assets/js/main.custom.js"></script>
</body>

</html>
