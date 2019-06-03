<?php
    include_once 'app/includes/header.php';
?>
    <div class="container">
        <div class="row ">
            <div class="col s8 offset-s2 center-align">
                <h1>Upload Images</h1>
            </div>
            <div class="feedback col s12 center-align"></div>
            <form id="upload-form" class="col s12 card-panel teal darken-4 z-depth-2" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Choose file(s)</span>
                            <input type="file" name="image[]" id="image" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path white-text" type="text" placeholder=".jp(e)g, .png, .gif only">
                        </div>
                    </div>
                    <div class="col s12 center-align">
                        <button class="btn waves-effect waves-light" type="submit" name="submit" >Upload !
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
include_once 'app/includes/footer.php';
?>

