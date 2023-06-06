    <!--Delete master account Modal -->
    <div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Trading Account </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to detele trading master account?
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <a href="{{ route('del.master', ['id' => $item['id']]) }}" type="button"
                            class="btn btn-danger">
                            Yes Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
