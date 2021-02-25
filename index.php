<?php include "_partials/header.php" ?>

    <div class="page-header">
        <h1>TODO</h1>
    </div>

    <?php $data = $database->select('items', 'text'); ?>

    <ul class="list-group pull-left col-sm-6">
        <?php 
            foreach ($data as $item) {
                echo '<li class="list-group-item">' . $item . '</li>';
            }
        ?>
    </ul>

    <form class="col-sm-6 pull-right" action="_inc/add-new.php" method="post">
        <p class="form-group">
            <textarea class="form-control" name="message" id="text" rows="3">
            </textarea>
        </p>

        <p class="form-group">
            <input class="btn-sm btn-danger" type="submit" value="add new thing">
        </p>
    </form>


<?php include "_partials/footer.php" ?>