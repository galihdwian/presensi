<section id="recent-works">
    <div class="singlepage">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Profil Pejabat Sruktural RSUD Prof. Dr. Margono Soekarjo Purwokerto</h2>
                <hr>
            </div>
            <div class="row">
                <div class="center">
                    <div class="button-group filters-button-group">
                        <button class="btn btn-danger btn-outline is-checked" data-filter="*">Semua Pejabat</button>
                        <button class="btn btn-danger btn-outline" data-filter=".wadiryan">Pelayanan & Kerjasama</button>
                        <button class="btn btn-danger btn-outline" data-filter=".wadirjangdik">Penunjang & Pendidikan</button>
                        <button class="btn btn-danger btn-outline" data-filter=".wadiruk">Umum & Keuangan</button>
                    </div>
                </div> 
                <?php //print_r($get_struktur_pegawai); ?>
                <div class="grid">                                 
                    <?php
                    $root_url = "https://" . $_SERVER['HTTP_HOST'];
                    $datafilter = NULL;
                    $kabid = NULL;
                    $kasie = NULL;
                    foreach ($get_struktur_pegawai as $r_str) {
                        if (!empty($r_str['nama_pegawai'])) {
                            ?>                    
                            <div class="col-xs-12 col-sm-4 col-md-3 element-item dir">
                                <div class="recent-work-wrap maxh222">
                                    <div class="border-grid">
                                        <?php
                                        if (!empty($r_str['foto_profil'])) {
                                            echo '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/' . $r_str['foto_profil']) . '" alt="">';
                                        } else {
                                            echo '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/default.png') . '" alt="">';
                                        }
                                        ?>
                                        <div class="overlay-wide">
                                            <div class="recent-work-inner">
                                                <h5><?php echo $r_str['nama_struktur']; ?></h5>
                                                <?php
                                                echo '<p>' . $r_str['nama_pegawai'] . '</p><p>NIP. ' . $r_str['id_pegawai'] . '</p>';
                                                ?>  
                                                <a href="javascript:void(0)" onclick="showmodal(this.id)" id="<?php echo str_replace(" ", "-", $r_str['id_pegawai']); ?>"><i class="fa fa-eye"></i> Detail</a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <?php
                        }
                        $datafilter = NULL;
                        //wadir
                        foreach ($r_str['childstruktur'] as $r_child):
                            $datafilter = strtolower($r_child['str_alias']);
                            if (!empty($r_child['nama_pegawai'])) {
                                ?>
                                <div class="col-xs-12 col-sm-4 col-md-3 element-item <?php echo $datafilter; ?>">
                                    <div class="recent-work-wrap maxh222">
                                        <div class="border-grid">
                                            <?php
                                            if (!empty($r_child['foto_profil'])) {
                                                echo '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/' . $r_child['foto_profil']) . '" alt="">';
                                            } else {
                                                echo '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/default.png') . '" alt="">';
                                            }
                                            ?>
                                            <div class="overlay-wide">
                                                <div class="recent-work-inner">
                                                    <h5><?php echo $r_child['nama_struktur']; ?></h5>
                                                    <?php
                                                    echo '<p>' . $r_child['nama_pegawai'] . '</p><p>NIP. ' . $r_child['id_pegawai'] . '</p>';
                                                    ?>                                        
                                                    <a href="javascript:void(0)" onclick="showmodal(this.id)" id="<?php echo str_replace(" ", "-", $r_child['id_pegawai']); ?>"><i class="fa fa-eye"></i> Detail</a>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            //kabid
                            foreach ($r_child['childstruktur'] as $r_child2):
                                if (!empty($r_child2['nama_pegawai'])) {
                                    $kabid .= '<div class="col-xs-12 col-sm-4 col-md-3 element-item ' . $datafilter . '">';
                                    $kabid .= '<div class="recent-work-wrap maxh222">';
                                    $kabid .= '<div class="border-grid">';
                                    if (!empty($r_child2['foto_profil'])) {
                                        $kabid .= '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/' . $r_child2['foto_profil']) . '" alt="">';
                                    } else {
                                        $kabid .= '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/default.png') . '" alt="">';
                                    }
                                    $kabid .= '<div class="overlay-wide">';
                                    $kabid .= '<div class="recent-work-inner">';
                                    $kabid .= '<h5>' . $r_child2['nama_struktur'] . '</h5>';
                                    $kabid .= '<p>' . $r_child2['nama_pegawai'] . '</p><p>NIP. ' . $r_child2['id_pegawai'] . '</p>';
                                    $kabid .= '<a href="javascript:void(0)" onclick="showmodal(this.id)" id="' . str_replace(" ", "-", $r_child2['id_pegawai']) . '"><i class="fa fa-eye"></i> Detail</a>';
                                    $kabid .= '</div></div></div></div></div>';
                                }
                                //kasie
                                foreach ($r_child2['childstruktur'] as $r_child3):
                                    if (!empty($r_child3['nama_pegawai'])) {
                                        $kasie .= '<div class="col-xs-12 col-sm-4 col-md-3 element-item ' . $datafilter . '">';
                                        $kasie .= '<div class="recent-work-wrap maxh222">';
                                        $kasie .= '<div class="border-grid">';
                                        if (!empty($r_child3['foto_profil'])) {
                                            $kasie .= '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/' . $r_child3['foto_profil']) . '" alt="">';
                                        } else {
                                            $kasie .= '<img class="img-responsive" src="' . base_url('assets/images/pegawai/profilpejabat/default.png') . '" alt="">';
                                        }
                                        $kasie .= '<div class="overlay-wide">';
                                        $kasie .= '<div class="recent-work-inner">';
                                        $kasie .= '<h5>' . $r_child3['nama_struktur'] . '</h5>';
                                        $kasie .= '<p>' . $r_child3['nama_pegawai'] . '</p><p>NIP. ' . $r_child3['id_pegawai'] . '</p>';
                                        $kasie .= '<a href="javascript:void(0)" onclick="showmodal(this.id)" id="' . str_replace(" ", "-", $r_child3['id_pegawai']) . '"><i class="fa fa-eye"></i> Detail</a>';
                                        $kasie .= ' </div></div></div></div></div>';
                                    }
                                endforeach;
                                unset($r_child3);
                            endforeach;
                            unset($r_child2);
                        endforeach;
                    }
                    unset($r_str);
                    echo $kabid;
                    echo $kasie;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">  
                <div class="modal-header">
                    <h4 class="modal-title">Profil Pejabat Struktural PPID RSUD Prof. Dr. Margono Soekarjo Purwokerto</h4>
                </div>
                <div id="modaldetailcontent"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/isotope.pkgd.min.js'); ?>"></script>
    <script>
                                                        // external js: isotope.pkgd.js
                                                        // init Isotope
                                                        var $grid = $('.grid').isotope({
                                                            itemSelector: '.element-item',
                                                            layoutMode: 'fitRows'
                                                        });
                                                        // filter functions
                                                        var filterFns = {
                                                            // show if number is greater than 50
                                                            numberGreaterThan50: function () {
                                                                var number = $(this).find('.number').text();
                                                                return parseInt(number, 10) > 50;
                                                            },
                                                            // show if name ends with -ium
                                                            ium: function () {
                                                                var name = $(this).find('.name').text();
                                                                return name.match(/ium$/);
                                                            }
                                                        };
                                                        // bind filter button click
                                                        $('.filters-button-group').on('click', 'button', function () {
                                                            var filterValue = $(this).attr('data-filter');
                                                            // use filterFn if matches value
                                                            filterValue = filterFns[ filterValue ] || filterValue;
                                                            $grid.isotope({filter: filterValue});
                                                        });
                                                        // change is-checked class on buttons
                                                        $('.button-group').each(function (i, buttonGroup) {
                                                            var $buttonGroup = $(buttonGroup);
                                                            $buttonGroup.on('click', 'button', function () {
                                                                $buttonGroup.find('.is-checked').removeClass('is-checked');
                                                                $(this).addClass('is-checked');
                                                            });
                                                        });
                                                        $(document).ready(function () {
                                                            $("#myModal").on("hidden.bs.modal", function () {
                                                                $('#myModal').find('#modaldetailcontent').html("");
                                                            });
                                                        });
                                                        function showmodal(id) {
                                                            //alert(id);
                                                            var href = "<?php echo $root_url; ?>/detailpejabat/" + id;
                                                            $('#myModal').find('#modaldetailcontent').load(href);
                                                            $('#myModal').modal('show');
                                                        }
    </script>
</section>