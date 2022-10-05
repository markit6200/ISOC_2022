<!doctype html>
<html lang="en">
    <head>

        <?= $title_meta ?>

		<?= $this->include('partials/head-css') ?>

    </head>

    <?= $this->include('partials/body') ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

        <?= $this->include('partials/left-menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                    <?php echo $this->renderSection('content') ?>
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


				<?= $this->include('partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

		<?= $this->include('partials/right-sidebar') ?>

		<?= $this->include('partials/vendor-scripts') ?>

        <!-- apexcharts -->
        <!-- <script src="<?php echo base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="<?php echo base_url() ?>/assets/js/pages/dashboard.init.js"></script> -->
        <script>
            var baseUrl = '<?php echo base_url() ?>';
        </script>
        <?php echo $this->renderSection('jsContent') ?>
        <script src="<?php echo base_url() ?>/assets/js/app.js?t=<?php echo date('YmdHis') ?>"></script>

    </body>

</html>