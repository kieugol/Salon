

                <ul class="img-list" id="all_list">              

                <?php

                    foreach ($list_images as $value) {

                    ?>

                        <li>

                            <a href="#" data-dismiss="modal" imgname="<?php echo $value->name_file ?>" id="img-list"  >

                                <img width="100" height="80"src="<?php echo Asset('/')."store/upload/images/".$value->name_file ?>">

                             </a>

                        </li>

                <?php 

                        }

                    ?>

                </ul>