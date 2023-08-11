<!-- AJAX !-->



<?php
            if(isset($_SESSION['error'])):?>
	        <div style="color:red;"><?= $_SESSION['error'] ?></div>
            <?php endif;?>

        <form action="<?php echo base_url('index.php/dashboard/update-officials/'.$officials_data->id); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-row">
                <div style="width: 230px; max-height: 330px; align-items: center; border-radius: 6px;" class="form-group" id="image-preview">
                <center>  
                    <img height="200px" width="200px" style="margin-top: 10px; height:180px; width: 180px; object-fit: cover; border-radius: 50%; overflow: hidden;   object-position: center;" src="<?php echo base_url($officials_data->image); ?>" alt="Uploaded Image" class="img-thumbnail">
                    <hr style="margin-left: 10px; border: 1px solid #ccc; max-width: 200px; margin-bottom: 30px;">
                </center>   

                <center>  <strong><span style="color: black;">Upload Photo</span></strong> </center>

                
                <center> 
                    <div  id="image-upload-form" style="width: 110px; margin-top: 5px; margin-left: 100px;"  class="custom-file">
                        <label id="fileLabel" style="margin-left: -100px; text-align: left; " class="custom-file-label" for="image"></label>
                        <input style="padding-bottom: 0px;" type="file" name="image" id="image" class="custom-file-input" accept="image/*"/>
                        <span><?= form_error('image') ?></span>
                    </div>
                </center>  
            </div>
                    
                <?php
                    if(isset($_SESSION['error'])):?>
	                <div style="color:red;"><?= $_SESSION['error'] ?></div>
                    <?php endif;?>

                <?php
                    if(isset($_SESSION['success'])):?>
	                <div style="color:green;"><?= $_SESSION['success'] ?></div>
                <?php endif;?>
    
                <br>
                           
                </div>


<form method="post" action="<?php echo base_url('index.php/dashboard/update-officials/'.$officials_data->id); ?>">
   <div class="form-group">
      <label for="position">Position:</label>
      <input type="text" name="position" value="<?php echo $officials_data->position; ?>" id="position" class="form-control" required />
      <span><?= form_error('position') ?></span>
   </div>
   <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" value="<?php echo $officials_data->name; ?>" id="name" class="form-control" required />
      <span><?= form_error('name') ?></span>
   </div>
   <div class="form-group">
      <label for="contact">Contact:</label>
      <input type="text" name="contact" value="<?php echo $officials_data->contact; ?>" id="contact" class="form-control" required />
      <span><?= form_error('contact') ?></span>
   </div>
   <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" name="address" value="<?php echo $officials_data->address; ?>" id="address" class="form-control" required />
      <span><?= form_error('address') ?></span>
   </div>
   <div class="form-group">
      <label for="start_term">Start of Term:</label>
      <input type="date" name="start_term" value="<?php echo $officials_data->start_term; ?>" id="start_term" class="form-control" required />
      <span><?= form_error('start_term') ?></span>
   </div>
   <div class="form-group">
      <label for="end_term">End of Term:</label>
      <input type="date" name="end_term" value="<?php echo $officials_data->end_term; ?>" id="end_term" class="form-control" required />
      <span><?= form_error('end_term') ?></span>
   </div>
   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Update</button>
   </div>
</form>

<script>
$(document).ready(function() {
    // Listen for the 'change' event on the file input
    $('#image').change(function() {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Update the image preview with the selected image
                $('#image-preview img').attr('src', e.target.result);
            };

            // Read the image as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#image-upload-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '<?= base_url('index.php/dashboard/addofficials') ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.image_path) {
                    $('#image-preview img').attr('src', '<?= base_url() ?>' + data.image_path);
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
                $('#image-error').text('Error occurred during image upload.');
            }
        });
    });
});
</script>


<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Choose file';
        document.getElementById('fileLabel').innerText = fileName;
    });
</script>




