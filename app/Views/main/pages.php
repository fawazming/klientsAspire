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

    <!-- rts blog mlist area -->
    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <!-- <div class="row g-5"> -->
                <!-- rts blo post area -->
                <!-- <div class="col-xl-8 col-md-12 col-sm-12 col-12"> -->
                    <!-- single post -->
                    <div class="blog-single-post-listing details mb--0">
                        <div class="blog-listing-content">
                            <h3 class="title"><?=$title?></h3>
                            <div class="user-info">
                                <!-- single info -->
                                <div class="single">
                                    <i class="far fa-clock"></i>
                                    <span><?=$published?></span>
                                </div>
                                <!-- single infoe end -->
                                <!-- single info -->
                                <div class="single">
                                    <i class="far fa-tags"></i>
                                    <span><?=$labels?></span>
                                </div>
                                <!-- single infoe end -->
                            </div>
                            <div class="disc">
                              <?=$content?>
                            </div>
                      
                            <div class="row  align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <!-- tags details -->
                                   <!--  <div class="details-tag">
                                        <h6>Tags:</h6>
                                        <button>Services</button>
                                        <button>Business</button>
                                        <button>Growth</button>
                                    </div> -->
                                    <!-- tags details End -->
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="details-share">
                                        <h6>Share:</h6>
                                        <button class="shared"><i class="fab fa-facebook-f"></i></button>
                                        <button class="shared"><i class="fab fa-twitter"></i></button>
                                        <button class="shared"><i class="fab fa-instagram"></i></button>
                                        <button class="shared"><i class="fab fa-linkedin-in"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="author-area">
                                <div class="thumbnail details mb_sm--15">
                                    <img src="assets/images/blog/details/author.jpg" alt="finbiz_buseness">
                                </div>
                                <div class="author-details team">
                                    <span>Brand Designer</span>
                                    <h5>Angelina H. Dekato</h5>
                                    <p class="disc">
                                        Nullam varius luctus pharetra ultrices volpat facilisis donec tortor, nibhkisys
                                        habitant curabitur at nunc nisl magna ac rhoncus vehicula sociis tortor nist
                                        hendrerit molestie integer.
                                    </p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- single post End-->
                <!-- </div> -->
                <!-- rts-blog post end area -->
              <!-- </div> -->
            </div>
          </div>
          <script>
            const shareData = {
              title: "<?=$title?>",
              text: "Read more about the topic <?=$title?>",
              url: "<?=$url?>",
            };

            const btn = document.querySelector("button.shared");
            // const resultPara = document.querySelector(".result");

            // Share must be triggered by "user activation"
            btn.addEventListener("click", async () => {
              try {
                await navigator.share(shareData);
                console.log('Shared');
                // resultPara.textContent = "MDN shared successfully";
              } catch (err) {
                // resultPara.textContent = `Error: ${err}`;
              }
            });
          </script>