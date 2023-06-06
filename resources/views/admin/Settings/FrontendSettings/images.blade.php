<a href="#" data-toggle="modal" data-target="#images" class="btn btn-primary">
    <i class="fa fa-plus"></i> Add Image</a>
<div id="images" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title" style="text-align:center;">Add Image</h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="{{ route('saveimg') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <h5 class="">Title of Image</h5>
                        <input type="text" name="img_title" placeholder="Name of Image" class="form-control  ">
                    </div>
                    <div class="form-group">
                        <h5 class="">Images Description</h5>
                        <textarea name="img_desc" placeholder="Describe the image" class="form-control  " rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <h5 class="">Image</h5>
                        <small>Note: Images Uploaded will be renamed by our system to
                            'random_characters/name_of_file/random_number'.</small>
                        <input name="image" class="form-control  " type="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>
    </div>
</div>
