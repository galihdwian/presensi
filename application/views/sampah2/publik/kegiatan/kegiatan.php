<section id="blog" class="container">
    <div class="content-wrap">
        <div class="container">
            <div class="row gutter-40 col-mb-80">
                <!-- =========== Post Content ======================== -->
                <div class="postcontent col-lg-12">
                    <div id="posts" class="row grid-container gutter-40">
                        <?php
                        foreach ($list_kegiatan as $r) :
                        ?>
                            <div class="entry col-12">
                                <div class="grid-inner row g-0">
                                    <div class="col-md-4">
                                        <div class="entry-image">
                                            <a href="<?= site_url('kegiatan/detail_kegiatan/') . $r->id; ?>"><img src=" <?= base_url($r->foto) ?>" style="height: 200px; width: 320px"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 ps-md-4">
                                        <div class="entry-title title-sm">
                                            <h2><a style="color: red" href="<?= site_url('kegiatan/detail_kegiatan/') . $r->id; ?>"><?= $r->judul ?></a></h2>
                                        </div>
                                        <div class="entry-meta">
                                            <ul>
                                                <li style="color: black"><i class="icon-calendar3"></i> <?= $r->updated_at !== null ?  date('d F Y', strtotime($r->created_at)) :  date('d F Y', strtotime($r->created_at)) ?> <?= $r->updated_at !== null ?  "<i></i>" :  "" ?></li>
                                            </ul>
                                        </div>
                                        <div class="entry-content">
                                            <div style="color: black">
                                                <p><?= substr(strip_tags($r->isi), 0, 500) ?> . . .</p>
                                            </div> <a href="<?= site_url('kegiatan/detail_kegiatan/') . $r->id; ?>" class="more-link"><b>Baca Selengkapnya</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            </br>
                        <?php
                        endforeach
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination">
            <?php
            echo $this->pagination->create_links();
            ?>
        </div>
    </div>
</section>
<style>
    .pagination {
        display: flex;
        padding: 1em 0;
    }

    .pagination a,
    .pagination strong {
        border: 1px solid silver;
        border-radius: 8px;
        color: black;
        padding: 0.5em;
        margin-right: 0.5em;
        text-decoration: none;
    }

    .pagination a:hover,
    .pagination strong {
        border: 1px solid #008cba;
        background-color: #008cba;
        color: white;
    }
</style>