<!-- Submit MT4 MODAL modal -->
<div id="masterModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Create a Master Account</h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form role="form" method="post" action="{{ route('create.master') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <label>Login*:</label>
                            <input class="form-control" type="text" name="login" required>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label>Account Password*:</label>
                            <input class="form-control  " type="text" name="password" required>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label>Account Name*:</label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label>Server*:</label>
                            <input class="form-control " Placeholder="E.g. HantecGlobal-live" type="text"
                                name="serverName" required>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label>Account Type:</label>
                            <input class="form-control  " Placeholder="E.g. Standard" type="text" name="acntype"
                                required>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label>Leverage:</label>
                            <input class="form-control  " Placeholder="E.g. 1:500" type="text" name="leverage"
                                required>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label>Currency:</label>
                            <input class="form-control" Placeholder="E.g. USD" type="text" name="currency" required>
                        </div>
                        <div class="form-group col-md-12 text-left">
                            <input type="submit" class="btn btn-primary" value="Add Account">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
