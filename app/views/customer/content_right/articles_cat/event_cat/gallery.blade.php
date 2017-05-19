
                <table id="tb2" class="table table-bordered table-hover tb-img">
                    <thead>
                        <tr>
                            <th>images</th>
                        </tr>

                    </thead>
                    <tbody>
                   
                <?php
                    foreach ($list_images as $value) {
                    ?>
                     <tr>
                        <td> 
                         <a href="#"  data-dismiss="modal" imgname="<?php echo $value->name_file ?>" id="img-list"  >
                            <img  src="<?php echo Asset('/')."store/upload/images/".$value->name_file ?>">
                         </a>
                        </td>
                     </tr> 
                <?php 
                    }
                    ?>
                    
                    </tbody>
                </table>
                