<?php include_once("header.php"); ?>

<div class="nk-content">
    <form method="post" id="myform" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="txt">Text</label>
                    <input type="text" name="txt" id="txt" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="likes">Likes</label>
                    <input type="text" name="likes" id="likes" class="form-control" value="">
                </div>
            </div>
            <input type="hidden" name="clg_id" id="clg_id" value="<?php echo $clg_id; ?>">
            <input type="submit" value="Submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

<?php include_once("footer.php"); ?>