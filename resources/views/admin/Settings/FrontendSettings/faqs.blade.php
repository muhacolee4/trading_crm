<a href="#" data-toggle="modal" data-target="#faqmodal" class="btn btn-primary"><i class="fa fa-plus"></i> Add FAQ</a>
<div id="faqmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title" style="text-align:center;">Add Faq</h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="{{ route('savefaq') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <h5 class="">Question</h5>
                        <input type="text" name="question" placeholder="Enter the Question here"
                            class="form-control  " required>
                    </div>
                    <div class="form-group">
                        <h5 class="">Answer</h5>
                        <textarea name="answer" placeholder="Enter the Answer to the question above" class="form-control  " rows="4"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>
    </div>
</div>
