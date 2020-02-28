
            <section>
                <div class="container">
                    <div class="masonry">
                        <div class="masonry__container row masonry--active">
                            <?php 
                            foreach($products as $p){
                            ?>
                            <div class="col-md-4 masonry__item">
                                <div class="card card-2 text-center">
                                    <div class="card__top">
                                        <a href="#"> <img alt="<?php echo $p->Name();?>" src="<?php echo $p->Image();?>"> </a>
                                    </div>
                                    <div class="card__body">
                                        <h4><?php echo $p->Name();?></h4> 
                                        <span class="type--fade">
                                        <?php echo $p->Shortdesc();?>
                                        </span>
                                    </div>
                                    <div class="card__bottom text-center">
                                        <div class="card__action"> <span class="h6 type--uppercase">查看細節</span>
                                            <a href="/shop/info/?id=<?php echo $p->ID();?>"> <i class="material-icons">flip_to_front</i> </a>
                                        </div>
                                        <div class="card__action"> <span class="h6 type--uppercase">加到最愛</span>
                                            <a href="#"> <i class="material-icons">favorite_border</i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>


            <section class="text-center cta cta-4 space--xxs border--bottom imagebg" data-gradient-bg="#4876BD,#5448BD,#8F48BD,#BD48B1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"> <span class="label label--inline">Hot!</span> <span>專業遊戲代練團隊，提供完善且專業的服務。提供國際玩家最貼心迅速的服務</span> </div>
                    </div>
                </div>
            </section>