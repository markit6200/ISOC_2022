<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu-ex') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <?= $page_title ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input id="title" type="text" class="input-large form-control" placeholder="Enter a title ..." />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Message</label>
                                                    <textarea class="input-large form-control" id="message" rows="3" placeholder="Enter a message ..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group my-4">

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="closeButton" value="checked">
                                                <label class="form-check-label" for="closeButton">Close Button</label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="addBehaviorOnToastClick" value="checked">
                                                <label class="form-check-label" for="addBehaviorOnToastClick">Add behavior on toast click</label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="debugInfo" value="checked">
                                                <label class="form-check-label" for="debugInfo">Debug</label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="progressBar" value="checked">
                                                <label class="form-check-label" for="progressBar">Progress Bar</label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="preventDuplicates" value="checked">
                                                <label class="form-check-label" for="preventDuplicates">Prevent Duplicates</label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="addClear" value="checked">
                                                <label class="form-check-label" for="addClear">Add button to force clearing a toast, ignoring focus</label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input input-mini" id="newestOnTop" value="checked">
                                                <label class="form-check-label" for="newestOnTop">Newest on top</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-2">
                                        <div class="control-group" id="toastTypeGroup">
                                            <div class="controls mb-4">
                                                <label class="form-label">Toast Type</label>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio1" name="radio" class="form-check-input" value="success" checked>
                                                    <label class="form-check-label" for="radio1">Success</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio2" name="radio" class="form-check-input" value="info">
                                                    <label class="form-check-label" for="radio2">Info</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio3" name="radio" class="form-check-input" value="warning">
                                                    <label class="form-check-label" for="radio3">Warning</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio4" name="radio" class="form-check-input" value="error">
                                                    <label class="form-check-label" for="radio4">Error</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="control-group" id="positionGroup">
                                            <div class="controls mb-4">
                                                <label class="form-label">Position</label>


                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio5" name="positions" class="form-check-input" value="toast-top-right" checked />
                                                    <label class="form-check-label" for="radio5">Top Right</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio6" name="positions" class="form-check-input" value="toast-bottom-right" />
                                                    <label class="form-check-label" for="radio6">Bottom Right</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio7" name="positions" class="form-check-input" value="toast-bottom-left" />
                                                    <label class="form-check-label" for="radio7">Bottom Left</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio8" name="positions" class="form-check-input" value="toast-top-left" />
                                                    <label class="form-check-label" for="radio8">Top Left</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio9" name="positions" class="form-check-input" value="toast-top-full-width" />
                                                    <label class="form-check-label" for="radio9">Top Full Width</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio10" name="positions" class="form-check-input" value="toast-bottom-full-width" />
                                                    <label class="form-check-label" for="radio10">Bottom Full Width</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio11" name="positions" class="form-check-input" value="toast-top-center" />
                                                    <label class="form-check-label" for="radio11">Top Center</label>
                                                </div>

                                                <div class="form-check mb-2">
                                                    <input type="radio" id="radio12" name="positions" class="form-check-input" value="toast-bottom-center" />
                                                    <label class="form-check-label" for="radio12">Bottom Center</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6">
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="mb-3">
                                                    <label class="form-label" for="showEasing">Show Easing</label>
                                                    <input id="showEasing" type="text" placeholder="swing, linear" class="input-mini form-control" value="swing" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="hideEasing">Hide Easing</label>
                                                    <input id="hideEasing" type="text" placeholder="swing, linear" class="input-mini form-control" value="linear" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="showMethod">Show Method</label>
                                                    <input id="showMethod" type="text" placeholder="show, fadeIn, slideDown" class="input-mini form-control" value="fadeIn" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="hideMethod">Hide Method</label>
                                                    <input id="hideMethod" type="text" placeholder="hide, fadeOut, slideUp" class="input-mini form-control" value="fadeOut" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6">
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="mb-3">
                                                    <label class="form-label" for="showDuration">Show Duration</label>
                                                    <input id="showDuration" type="text" placeholder="ms" class="input-mini form-control" value="300" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="hideDuration">Hide Duration</label>
                                                    <input id="hideDuration" type="text" placeholder="ms" class="input-mini form-control" value="1000" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="timeOut">Time out</label>
                                                    <input id="timeOut" type="text" placeholder="ms" class="input-mini form-control" value="5000" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="extendedTimeOut">Extended time out</label>
                                                    <input id="extendedTimeOut" type="text" placeholder="ms" class="input-mini form-control" value="1000" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-primary" id="showtoast">Show Toast</button>
                                            <button type="button" class="btn btn-danger" id="cleartoasts">Clear Toasts</button>
                                            <button type="button" class="btn btn-danger" id="clearlasttoast">Clear Last Toast</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <pre id='toastrOptions' class="toastr-options"></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

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

<!-- toastr plugin -->
<script src="assets/libs/toastr/build/toastr.min.js"></script>

<!-- toastr init -->
<script src="assets/js/pages/toastr.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>