    <!--Delete master account Modal -->
    <div class="modal fade" id="copytrade{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Start Copy Trade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cptrade') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscriberid" value="{{ $item['id'] }}">
                        <label for="">Select Master account to copy from.</label>
                        <select name="master" class="form-control mt-2 mb-4" required>
                            @foreach ($masters as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['account_name'] }}/{{ $item['login'] }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-primary m-1">
                            Start Copy Trade
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
