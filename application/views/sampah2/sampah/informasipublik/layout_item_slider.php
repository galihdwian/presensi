<section id="main-slider" class="no-margin">
    <div id="mycarousel"class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            for ($i = 0; $i < count($slide); $i++) {
                if ($i == 0) {
                    echo '<li data-target="#mycarousel" data-slide-to="' . $i . '" class="active"></li>';
                } else {
                    echo '<li data-target="#mycarousel" data-slide-to="' . $i . '"></li>';
                }
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($slide as $r_slide) {
                if ($i == 0) {
                    echo '<div class="item active" style="background-image: url(' . base_url('assets/images/slider/' . $r_slide['background']) . ')">';
                } else {
                    echo '<div class="item" style="background-image: url(' . base_url('assets/images/slider/' . $r_slide['background']) . ')">';
                }
                ?>
                <div class="container">
                    <div class="row slide-margin">
                        <!--                        <div class="col-sm-6">
                                                    <div class="carousel-content">
                                                        <h1 class="animation animated-item-1">Lorem ipsum dolor sit amet consectetur adipisicing elit</h1>
                                                        <h2 class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
                                                        <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                                                    </div>
                                                </div>-->
                        <div class="col-sm-12 animation animated-item-1">
                            <!--<div class="slider-img">-->
                            <img src="<?php echo base_url('assets/images/slider/' . $r_slide['gambar']); ?>" class="img-responsive">
                            <!--</div>-->
                        </div>

                    </div>
                </div>
                <?php
                echo '</div>';
                $i++;
            }
            unset($i, $r_slide);
            ?>
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#mycarousel" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#mycarousel" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section><!--/#main-slider--> 