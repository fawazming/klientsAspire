<!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg11 bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">Blog</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="<?=base_url('/')?>">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Blog Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->



    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <!-- <div class="row g-5"> -->
                <!-- <div class="col-xl-8 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0"> -->
                    <div class="row g-5">
                        <?php foreach ($blogs as $key => $blog):?>
                        <div class="col-lg-6 col-md-6">
                            <div class="rts-blog-h-2-wrapper">
                                <a href="<?=base_url()?>blog/<?=substr($blog->url, 34)?>" class="thumbnail">
                                    <?php $re = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i';preg_match($re, $blog->content, $matches, PREG_OFFSET_CAPTURE, 0); $extractedIMG = $matches[1][0]; ?>
                                    <img src="<?=$extractedIMG?>" alt="">
                                </a>
                                <div class="body">
                                    <span><?=$blog->labels[0]?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <i class="fal fa-time"></i>15 Jan<span></span></span>

                                    <a href="<?=base_url()?>blog/<?=substr($blog->url, 34)?>">
                                        <h4 class="title"><?=$blog->title?></h4>
                                    </a>
                                    <p><?=substr($blog->content, 0, 160)?>...</p>
                                    <a class="rts-read-more btn-primary" href="<?=base_url()?>blog/<?=substr($blog->url, 34)?>"><i class="far fa-arrow-right"></i>Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="blog-grid-inner">
                                <div class="blog-header">
                                    <a class="thumbnail" href="blog-details.html">
                                        <img src="assets/images/blog/grid/01.jpg" alt="Business_Blog">
                                    </a>
                                    <div class="blog-info">
                                        <div class="user">
                                            <i class="fal fa-user-circle"></i>
                                            <span>by Smith</span>
                                        </div>
                                        <div class="user">
                                            <i class="fal fa-tags"></i>
                                            <span>Business</span>
                                        </div>
                                    </div>
                                    <div class="date">
                                        <h6 class="title">15</h6>
                                        <span>Jan</span>
                                    </div>
                                </div>
                                <div class="blog-body">
                                    <a href="blog-details.html">
                                        <h5 class="title">
                                            Building smart business grow solution for you
                                        </h5>
                                    </a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>