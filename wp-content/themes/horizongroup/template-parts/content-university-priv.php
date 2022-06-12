<?php

global $wpdb;

$result = $args['result'];
?>
<style>
    .columns {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
    }
    .degree_no_wrap{
        white-space: nowrap;
    }
    .tr_center{
        text-align: -webkit-center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-11">
            <div class="blog-all-wrap mr-40" style="width:fit-content">
                <div class="row" dir="ltr">
                    <?php if (count($result) == 0) { ?>
                        <div class="col-lg-12">
                            <h3 style="text-align: center;">
                                لم يتم العثور على جامعات
                            </h3>
                        </div>
                    <?php } else { ?>





                        <div class="container table-responsive py-5">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr class="tr_center">
                                        <th scope="col">Logo</th>
                                        <th scope="col">University</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Information</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Link</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php for ($i = 0; $i < count($result); $i++) {  ?>
                                        <tr class="tr_center">
                                            <td><img src="<?php echo $result[$i]->logo ?>" width="45" height="45" /></td>
                                            <td>
                                                <p><?php echo $result[$i]->university ?></p>
                                            </td>
                                            <td>
                                            <ul style="text-align:-webkit-left">
                                            <li class="degree_no_wrap"> <strong><?php echo $result[$i]->program . " of " . $result[$i]->degree_name ?> </strong></li>
                                            <li class="degree_no_wrap"> <strong> <del>Tuition - USD : </strong><?php echo $result[$i]->price_befor_discount ?> <del></li>
                                            <li class="degree_no_wrap"> <strong> USD ($) : </strong> <?php echo $result[$i]->price_after_discount ?></li>
                                            </ul> 
                                        </td>
                                            <td>
                                                <ul style="text-align:-webkit-left">
                                            <li class="degree_no_wrap"> <strong>   Area Of Study : </strong><?php echo $result[$i]->area_of_study ?></li>
                                            <li class="degree_no_wrap"> <strong> Program Language :  </strong><?php echo $result[$i]->program_language ?></li>
                                            <li class="degree_no_wrap">    <strong> Program Level : </strong><?php echo $result[$i]->program_level ?></li>
                                                </ul>
                                              </td>
                                            <td><?php echo $result[$i]->location ?></td>
                                            <td><?php echo $result[$i]->Status == 0 ? "Unavaliable" : "Avaliable" ?></td>
                                            <td><?php echo $result[$i]->link ?></td>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
</div>