<section id="blog" class="container">
    <div class="blog">
        <div class="row">
            <div class="col-md-8">
                <?php
                print_r($showklasifikasi);
                if (!empty($showklasifikasi)):
                    foreach ($showklasifikasi as $r_klasifikasi):
                        $url_alias = $r_klasifikasi['url_alias'];
                        ?>
                        <div class="center">
                            <h2>Informasi Publik <?php echo $r_klasifikasi['nama_ppid']; ?></h2>
                            <p class="lead justify"><?php echo $r_klasifikasi['penjelasan']; ?></p>
                        </div>
                        <div class="blog-item"> 
                            <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                                <h2>Daftar Informasi Publik <?php echo $r_klasifikasi['nama_ppid']; ?></h2>
                                <hr>
                                <div class="widget search">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari Dokumen" name="srch-term" id="searchkey">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btn-outline" id="searchbutton"><i class="glyphicon glyphicon-search"></i> Cari</button>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger btn-outline" id="reset" onclick="ResetData()"><i class="fa fa-power-off"></i> Tampilkan Semua Data</button>
                                        </div>
                                    </div>
                                </div><!--/.search-->
                                <div id="ajaxdata">
                                    <?php include 'klasifikasi_pagination.php'; ?>
                                </div>
                            </div>
                        </div><!--/.blog-item-->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-xlg" role="document">
                                <div class="modal-content">
                                    <div id="klasifikas_filemodal"></div>
                                </div>
                            </div>
                        </div>                        
                        <?php
                    endforeach;
                    unset($r_klasifikasi);
                endif;
                ?>
            </div><!--/.col-md-8-->

            <div class="col-md-4">
                <div class="widget categories">
                    <h3>Categories</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="blog_category">
                                <li><a href="#">Computers <span class="badge">04</span></a></li>
                                <li><a href="#">Smartphone <span class="badge">10</span></a></li>
                                <li><a href="#">Gedgets <span class="badge">06</span></a></li>
                                <li><a href="#">Technology <span class="badge">25</span></a></li>
                            </ul>
                        </div>
                    </div>                     
                </div><!--/.categories-->

                <div class="widget archieve">
                    <h3>Archieve</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="blog_archieve">
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> December 2013 <span class="pull-right">(97)</span></a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> November 2013 <span class="pull-right">(32)</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> October 2013 <span class="pull-right">(19)</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> September 2013 <span class="pull-right">(08)</a></li>
                            </ul>
                        </div>
                    </div>                     
                </div><!--/.archieve-->               
            </div>  
        </div><!--/.row-->

        <script type="text/javascript">
                                                $(function() {
                                                    applyPagination();
                                                    searchRecord();
                                                    function applyPagination() {
                                                        var searchkey = $('#searchkey').val();
                                                        $('#ajax_paging a').click(function() {
                                                            var url = $(this).attr('href');
                                                            $.ajax({
                                                                beforeSend: function() {
                                                                    $('#loading2').show();
                                                                    $('#fadeloading').show();
                                                                },
                                                                complete: function() {
                                                                    $('#loading2').hide();
                                                                    $('#fadeloading').hide();
                                                                },
                                                                type: "POST",
                                                                data: {paging: 1, searchkey_p: searchkey},
                                                                url: url,
                                                                success: function(msg) {
                                                                    $('#ajaxdata').html(msg);
                                                                    applyPagination();
                                                                },
                                                                error: function(msg) {
                                                                    $('#ajaxdata').html(msg);
                                                                    applyPagination();
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                    }
                                                    function searchRecord() {
                                                        $('#searchbutton').click(function() {
                                                            var filter = $('#filter').val();
                                                            var searchkey = $('#searchkey').val();
                                                            var urlsearch = '<?php echo site_url('informasipubliksearch/' . $url_alias); ?>';
                                                            if (searchkey == '') {
                                                                alert('Kata Kunci Pencarian Belum Dimasukan.');
                                                            } else {
                                                                //$("#searchkey").prop('disabled', true);
                                                                $.ajax({
                                                                    beforeSend: function() {
                                                                        $('#loading2').show();
                                                                        $('#fadeloading').show();
                                                                    },
                                                                    complete: function() {
                                                                        $('#loading2').hide();
                                                                        $('#fadeloading').hide();
                                                                    },
                                                                    type: "POST",
                                                                    data: {filter_p: filter, searchkey_p: searchkey},
                                                                    url: urlsearch,
                                                                    success: function(msg) {
                                                                        $('#ajaxdata').html(msg);
                                                                        applyPagination();
                                                                        viewrecord();
                                                                    },
                                                                    error: function(msg) {
                                                                        $('#ajaxdata').html(msg);
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }
                                                });
                                                function showdata(id) {
                                                    var href = "<?php echo site_url('informasipublikfile'); ?>/" + id
                                                    $('#myModal').find('#klasifikas_filemodal').load(href);
                                                    $('#myModal').modal('show');
                                                }
                                                function ResetData() {
                                                        var url = "<?php echo site_url($url_alias);?>";
                                                        $.ajax({
                                                            beforeSend: function() {
                                                                $('#loading2').show();
                                                                $('#fadeloading').show();
                                                            },
                                                            complete: function() {
                                                                $('#loading2').hide();
                                                                $('#fadeloading').hide();
                                                            },
                                                            type: "POST",
                                                            data: {paging: 1},
                                                            url: url,
                                                            success: function(msg) {
                                                                $('#ajaxdata').html(msg);
                                                                applyPagination();
                                                            },
                                                            error: function(msg) {
                                                                $('#ajaxdata').html(msg);
                                                                applyPagination();
                                                            }
                                                        });
                                                        return false;
                                                }
        </script>
    </div><!--/.blog-->
</section>