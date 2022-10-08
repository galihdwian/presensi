<section id="blog" class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="center">
                <h2>Visi RSUD Prof. Dr. Margono Soekarjo</h2>
            </div>
            <div class="blog-item"> 
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <p class="center">"Prima Dalam Pelayanan Sub Spesialistik & Pendidikan Profesi"</p>
                    <hr>
                </div>
            </div>
            <div class="center">
                <h2>Misi RSUD Prof. Dr. Margono Soekarjo</h2>
            </div>
            <div class="blog-item"> 
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <div class="listshow">
                        <ol>
                            <li>Menyelenggarakan pelayanan kesehatan rujukan sub spesialistik.</li>
                            <li>Menyelenggarakan pendidikan, penelitian dan pengabdian masyarakat di bidang kesehatan.</li>
                            <li>Mengembangkan kualitas Sumber Daya Manusia (SDM) melalui peningkatan profesionalisme dan kesejahteraan.</li>
                            <li>Mengembangkan sarana dan prasarana yang unggul, tepat dan aman.</li>
                            <li>Mengembangkan sistem manajemen yang handal, transparan, akuntabel, efektif & efisien.</li>
                        </ol>
                        <hr>
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-md-4">
            <?php
            echo '<div class="widget categories">';
            $this->load->view('informasipublik/v_jenis_informasi');
            echo '</div>';
            //$this->load->view('informasipublik/sidebar_galeri');
            ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="blog-item"> 
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <?php $this->load->view('informasipublik/sidebar_galeri'); ?>                    
                </div>
            </div>
        </div>
    </div>
</section>