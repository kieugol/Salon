
                <?php
                    foreach ($list_images as $value) {
                    ?>
                        <li>
                            <a href="#" data-dismiss="modal" imgname="<?php echo $value->name_file ?>" id="img-list"  >
                                 <img width="100" height="80"  src="<?php echo Asset('/')."store/upload/images/".$value->name_file ?>"  data-toggle="tooltip" data-placement="top" title="{{$value->name_display}}" />
                             </a>
                        </li>
                <?php 
                        }
                    ?>
                
                    <?php
                            $min_id = 0;
                            foreach ($max_id as $result)
                                $min_id = $result->id;
                            // check min id
                            foreach ($max_id as $result) {
                                if($result->id < $min_id)
                                    $min_id = $result->id;
                             } 
                        ?>
                            <input type="hidden" name="max_id" id="max_id" value="{{$min_id}}" />
       
