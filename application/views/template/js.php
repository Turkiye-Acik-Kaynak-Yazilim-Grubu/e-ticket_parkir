    <script src="<?= base_url("assets/") ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/nprogress/nprogress.js"></script>

    <script src="<?= base_url("assets/") ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

    <script src="<?= base_url("assets/") ?>vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="<?= base_url("assets/") ?>build/js/custom.min.js"></script>

    <?php if ($this->session->userdata('role_id') == '2') { ?>
        <script type="text/javascript" src="<?= base_url("webcodecam/") ?>js/qrcodelib.js"></script>
        <script type="text/javascript" src="<?= base_url("webcodecam/") ?>js/webcodecamjquery.js"></script>
        <script type="text/javascript">
            var arg = {
                resultFunction: function(result) {
                    var redirect = '<?= base_url("Petugas/hasil_scan") ?>';
                    $.redirectPost(redirect, {
                        no_qr: result.code //no_qr
                    });
                }
            };

            var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
            decoder.buildSelectMenu("select");
            decoder.play();
            $('select').on('change', function() {
                decoder.stop().play();
            });

            // jquery extend function
            $.extend({
                redirectPost: function(location, args) {
                    var form = '';
                    $.each(args, function(key, value) {
                        form += '<input type="hidden" name="' + key + '" value="' + value + '">';
                    });
                    $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
                }
            });

            //CONFIGURASI CAMERA
            decoder.options.zoom = 0;
            decoder.options.flipHorizontal = true;
        </script>
    <?php } ?>