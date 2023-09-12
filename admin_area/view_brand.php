<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr>
            <th>SL.no</th>
            <th>Brand title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light text-center">

        <?php
        $select_query = "SELECT * FROM `brand` ";
        $result = mysqli_query($connection, $select_query);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            $number++;
        ?>
            <td><?php echo $number ?></td>
            <td><?php echo $brand_title ?></td>
            <td><a href="index.php?edit_brand=<?php echo $brand_id ?>" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href="index.php?delete_brand=<?php echo $brand_id ?>" type="button" class="text-light" data-toggle="modal" data-target="#exampleModal-<?php echo $brand_id ?>"><i class="fa-solid fa-duotone fa-trash"></i></a></td>
            </tr>

            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal-<?php echo $brand_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <h4>Are You Shure You Want to Delete This</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_brands" class="text-light text-decoration-none">NO</a></button>
                            <button type="button" class="btn btn-primary"><a href="index.php?delete_brand=<?php echo $brand_id ?>" class="text-light text-decoration-none">YES</a></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </tbody>
</table>