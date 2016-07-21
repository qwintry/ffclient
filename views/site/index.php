<?php

    /* @var $this yii\web\View */

    $this->title = 'My Yii Application';
?>
<div class="site-index">
    <section>
        <div class="row">
            <div class="col-lg-12">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="http://placehold.it/1140x320" alt="img1">
                            <div class="carousel-caption">
                                slide 1
                            </div>
                        </div>
                        <div class="item">
                            <img src="http://placehold.it/1140x320" alt="img2">
                            <div class="carousel-caption">
                                slide 2
                            </div>
                        </div>
                        ...
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span> </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center"><?= \Yii::t('app', 'You buy in US online stores. We deliver to Russia') ?>. <br>
                    <small><?= \Yii::t('app', 'Qwintry delivers worldwide') ?></small>
                </h1>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-4 col-md-4 front-you-buy front-you-buy-1 text-center">
                <div class="col-md-10">
                    <h3><?= \Yii::t('app', 'Buy') ?></h3>
                    <?= \Yii::t('app', '_buy_text') ?>
                </div>
            </div>


            <div class="col-sm-4 col-md-4 front-you-buy front-you-buy-2 text-center">
                <div class="col-md-10 col-md-offset-1">
                    <h3><?= \Yii::t('app', 'Consolidate') ?></h3>
                    <?= \Yii::t('app', '_consolidate_text') ?>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 front-you-buy front-you-buy-3 text-center">
                <div class="col-md-10 col-md-offset-2">
                    <h3><?= \Yii::t('app', 'Receive!') ?></h3>
                    <?= \Yii::t('app', '_receive_text') ?>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1><?= \Yii::t('app', 'Why should you use Qwintry?') ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 why-we-left">
                <div class="why-we why-we-1"><h3><?= \Yii::t('app', 'Smart Warehouse') ?></h3>
                    <p><?= \Yii::t('app', '_why_we_text_1') ?></p>
                </div>
                <div class="why-we why-we-2"><h3><?= \Yii::t('app', 'Hassle-Free Insurance') ?></h3>
                    <p><?= \Yii::t('app', '_why_we_text_2') ?></p>
                </div>
            </div>

            <div class="col-md-4 personaj-link">
                <img src="/images/personaj-default-big.gif" alt="Welcome!" title="Welcome to Qwintry!" border="0" class="img-responsive personaj-front">
            </div>


            <div class="col-md-4 why-we-right">
                <div class="why-we why-we-3"><h3><?= \Yii::t('app', 'User-Friendly Interface') ?></h3>
                    <p><?= \Yii::t('app', '_why_we_text_3') ?></p>
                </div>
                <div class="why-we why-we-4"><h3><?= \Yii::t('app', 'Customer Support 24/7') ?></h3>
                    <p><?= \Yii::t('app', '_why_we_text_4') ?></p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h1>
                    <?= \Yii::t('app', 'User reviews') ?><br>
                    <small><?= \Yii::t('app', '_user_reviews_text') ?></small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="review">
                    <div class="text">
                        <p>If someone is developing means of teleportation, they have been late. Banderolka got it right
                            and applies such technologies in real life. See for yourself. The package was shipped on
                            June 28, 2016, and delivered to Saint-Petersburg on July 04, 2016. I could not even dream
                            about it. To be fair, I should say, the delivery method was Qwintry Air. One important thing
                            to mention is the packaging. Two thumbs up. The box was not damaged, the tape had some
                            thread to stop somebody from temptation to gut the package. I have attached the photos. And
                            the last thing to say. Banderolka has realised there is no petty stuff about dealing with
                            customers. Otherwise, how would you explain a magnet with Banderolka's logo and some fruit
                            sweets were enclosed in the package. Thanks, and till new shipments.</p>
                    </div>
                    <div class="photos">
                        <div class="col-md-4">
                            <a href="https://qwintry.com/sites/default/files/styles/scrn/public/reviews/3188568/972641.jpg?itok=Fj6pD4ko" data-title="User review" data-gallery="gallery-node-3188568" data-toggle="lightbox">
                                <img class="img-responsive" src="https://qwintry.com/sites/default/files/styles/thumbnail/public/reviews/3188568/972641.jpg?itok=oEcXTAY2" alt="" title="">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://qwintry.com/sites/default/files/styles/scrn/public/reviews/3188568/972641.jpg?itok=Fj6pD4ko" data-title="User review" data-gallery="gallery-node-3188568" data-toggle="lightbox">
                                <img class="img-responsive" src="https://qwintry.com/sites/default/files/styles/thumbnail/public/reviews/3188568/972641.jpg?itok=oEcXTAY2" alt="" title="">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://qwintry.com/sites/default/files/styles/scrn/public/reviews/3188568/972641.jpg?itok=Fj6pD4ko" data-title="User review" data-gallery="gallery-node-3188568" data-toggle="lightbox">
                                <img class="img-responsive" src="https://qwintry.com/sites/default/files/styles/thumbnail/public/reviews/3188568/972641.jpg?itok=oEcXTAY2" alt="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="rating">
                        <div class="taring-stars" title="Excellent!">
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                        </div>
                    </div>
                    <div class="front-reviews-tracking">
                        <div class="front-reviews-created">
                            <span class="field-content">05.07.2016</span> —
                            <span class="field-content"><span title="Recipient address closest zipcode: 192076">Sankt-Peterburg, RU</span></span>,
                            Aleksandr P.
                        </div>
                        <div class="front-reviews-tracking-number">
                            <div class="field-content">
                                Qwintry Air
                                &nbsp;(<a target="_blank" href="http://logistics.qwintry.com/track?tracking=QR20155946">QR20155946</a>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="review">
                    <div class="text">
                        <p>I could not help using the special offer "The Package of Gadgets". All of my items have
                            packed as they should be. Besides, they were delivered at neck-breaking speed to a pickup
                            point, only within eight days. Moreover, I have saved about 12000 rubles. I am happy!</p>
                    </div>
                    <div class="photos">
                        <div class="col-md-4">
                            <a href="https://qwintry.com/sites/default/files/styles/scrn/public/reviews/3188568/972641.jpg?itok=Fj6pD4ko" data-title="User review" data-gallery="gallery-node-3188568" data-toggle="lightbox">
                                <img class="img-responsive" src="https://qwintry.com/sites/default/files/styles/thumbnail/public/reviews/3188568/972641.jpg?itok=oEcXTAY2" alt="" title="">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://qwintry.com/sites/default/files/styles/scrn/public/reviews/3188568/972641.jpg?itok=Fj6pD4ko" data-title="User review" data-gallery="gallery-node-3188568" data-toggle="lightbox">
                                <img class="img-responsive" src="https://qwintry.com/sites/default/files/styles/thumbnail/public/reviews/3188568/972641.jpg?itok=oEcXTAY2" alt="" title="">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://qwintry.com/sites/default/files/styles/scrn/public/reviews/3188568/972641.jpg?itok=Fj6pD4ko" data-title="User review" data-gallery="gallery-node-3188568" data-toggle="lightbox">
                                <img class="img-responsive" src="https://qwintry.com/sites/default/files/styles/thumbnail/public/reviews/3188568/972641.jpg?itok=oEcXTAY2" alt="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="rating">
                        <div class="taring-stars" title="Excellent!">
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                        </div>
                    </div>
                    <div class="front-reviews-tracking">
                        <div class="front-reviews-created">
                            <span class="field-content">05.07.2016</span> —
                            <span class="field-content"><span title="Recipient address closest zipcode: 192076">Sankt-Peterburg, RU</span></span>,
                            Aleksandr P.
                        </div>
                        <div class="front-reviews-tracking-number">
                            <div class="field-content">
                                Qwintry Air
                                &nbsp;(<a target="_blank" href="http://logistics.qwintry.com/track?tracking=QR20155946">QR20155946</a>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="view-all-reviews-bg">
                    <a href="/ru/users-reviews" title="Все отзывы"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <?= \Yii::t('app', 'All reviews') ?> (10000+)</a></h3>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class=" col-lg-12 logos-tried">
                <span class="they-tried"><?= \Yii::t('app', 'Qwintry was<br>tested by') ?>:</span>
                <a class="logos-tried-lifehacker ext" href="http://lifehacker.ru/2013/04/19/banderolka/" title="Lifehacker.ru about Qwintry" target="_blank"></a>
                <a class="logos-tried-droider ext" href="http://youtu.be/RtivDX8_fYU?t=11m22s" title="Droider about Qwintry" target="_blank"></a>
                <a class="logos-tried-yougifted ext" href="http://www.youtube.com/watch?feature=player_detailpage&amp;v=I2vl44ZeGLg#t=810" title="Yougifted about Qwintry" target="_blank"></a>
                <a class="logos-tried-mailru ext" href=" http://hi-tech.mail.ru/article/GoogleIO2014-live.html#contest" title="hi-tech.mail.ru contest with Qwintry" target="_blank"></a>
                <a class="logos-tried-exler ext" href="http://www.exler.ru/expromt/11-12-2013.htm" title="Экслер о Бандерольке" target="_blank"></a>
                <a class="logos-tried-ixbt ext" href="http://www.ixbt.com/portopc/microsoft-surface-pro2.shtml" title="iXBT о Бандерольке" target="_blank"></a>
                <a class="logos-tried-puregoogle ext" href="http://puregoogle.ru/2014/02/15/pokupaem-v-ssha-s-realnoj-vygodoj/" title="PureGoogle о Бандерольке" target="_blank"></a>
                <a class="logos-tried-rozetked hidden-md ext" href="http://youtu.be/p8oNfNOZQoo?t=3m26s" title="Розеткед о Бандерольке" target="_blank"></a>
            </div>
        </div>
    </section>

    <section>
        <?= \app\widgets\Calculator::widget() ?>
    </section>

    <section>
        <div class="row text-center">
            <a class="col-xs-4 col-sm-3 col-sm-offset-1 col-md-3 col-md-offset-1 col-lg-2 col-lg-offset-3 social-icon ext" title="Qwintry at Facebook" href="https://www.facebook.com/Qwintry" target="_blank">
                <img border="0" alt="Qwintry at Facebook" src="/images/icon-fb.jpg"><br> Qwintry at&nbsp;Facebook</a>
            <a class="col-xs-4 col-sm-3 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-2 social-icon ext" title="Qwintry at VK" href="https://vk.com/banderolkanews" target="_blank">
                <img border="0" alt="Qwintry at VK" src="/images/icon-vk.jpg"><br> Qwintry at&nbsp;VK </a>
            <a class="col-xs-4 col-sm-3 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-2 social-icon ext" title="Qwintry's Instagram" href="https://instagram.com/banderolka/" target="_blank">
                <img border="0" alt="Qwintry's Instagram" src="/images/icon-inst.jpg"><br> Qwintry's Instagram </a>


        </div>
    </section>

    <footer>
        <div class="row">
            <div class="col-lg-3">
                <div class="content-wrapper clearfix">
                    <p class="block-title h2">The Company</p>
                    <div class="content">
                        <ul class="menu clearfix">
                            <li class="first leaf"><a href="/en/terms" title="">Terms of Use</a></li>
                            <li class="leaf"><a href="/en/contact" title="">Contact Us</a></li>
                            <li class="leaf"><a href="/en/about">The Qwintry team</a></li>
                            <li class="last leaf"><a href="/en/users-reviews">User reviews</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="content-wrapper clearfix">
                    <p class="block-title h2">Useful stuff</p>
                    <div class="content">
                        <ul class="menu clearfix">
                            <li class="first leaf"><a href="/en/forbiddengoods" title="">List of prohibited items</a>
                            </li>
                            <li class="leaf"><a href="/en/amazon_store" title="">Amazon catalog</a></li>
                            <li class="last leaf">
                                <a href="https://qwintry.com/en/articles/rebates-earn-money-while-you-shop" title="">Rebates
                                    and discounts</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="content-wrapper clearfix">
                    <p class="block-title h2">Calculators</p>
                    <div class="content">
                        <ul class="menu clearfix">
                            <li class="first leaf">
                                <a href="https://qwintry.com/en/calculator" title="How much does it cost?">Qwintry
                                    Calculator</a></li>
                            <li class="leaf"><a href="/en/help/dim-weight" title="">Dimensional weight calculator</a>
                            </li>
                            <li class="last leaf"><a href="https://qwintry.com/en/payments" title="">Payment options</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="content-wrapper clearfix">
                    <p class="block-title h2">Cooperation</p>
                    <div class="content">
                        <ul class="menu clearfix">
                            <li class="first last leaf"><a href="/en/invite_friends" title="">Invite your friends</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
