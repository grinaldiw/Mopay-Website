<div class="col-md-4">
    <div class="alert alert-info">
        <strong>How To Add Account.</strong> <br>Fill all form with that required, fill <i>Username</i> for being email with extension <i>@student.smktelkom-mlg.sch.id</i>, fill Full Name with user full name based on student card, then send request to complete add account.
    </div>
    <form class="form-horizontal form-bordered" role="form" id="form-add">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Add Account</h4>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger" id="error" style="display: none;">
                    <strong>ERROR <i class="fa fa-times"></i></strong> : Failed to add account
                </div>
                <div class="alert alert-success" id="success" style="display: none;">
                    <strong>SUCCESS <i class="fa fa-check"></i></strong> : Success add account with email <i id="email"></i>
                </div>
                <div class="form-group">
                    <label for="inputEmail4" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-5" id="frmClass">
                        <input type="text" class="form-control" name="email" placeholder="Username for email">
                        <div id="suggesstion-box"></div>
                    </div>
                    <div class="col-sm-4">@student.smktelkom-mlg.sch.id</div>
                </div>
                <div class="form-group">
                    <label for="inputPassword4" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" placeholder="Full name">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-offset-7 col-sm-5">
                        <button type="button" class="btn btn-success" onclick="send()"><i class="fa fa-check"></i> Send</button>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<div class="col-md-8">
    <div class="alert alert-success">
        <strong>List All User.</strong> <br>Click <i class="fa fa-plus"></i> button to see detail like user balance and user email.
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Users List</h4>
        </div>
        <div class="panel-body">
            <table id="table-hidden-row-details2" class="table table-striped">
                <thead>
                    <tr>
                        <th width="7%">No.</th>
                        <th width="13%">User ID</th>
                        <th width="">Full Name</th>
                        <th width="">Status</th>
                        <th>Action</th>
                        <th style="display: none;">Platform(s)</th>
                        <th style="display: none;">Engine version</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($data as $key): ?>
                        <tr class="odd gradeX">
                            <td class="center"><?= $no; ?></td>
                            <td><label class="label label-info"><?= $key->user_id; ?></label></td>
                            <td><?= $key->name; ?></td>
                            <td><label class="label label-success"><?= $key->status; ?></label></td>
                            <td><button class="btn btn-danger btn-sm" onclick="deletes(<?= $key->user_id; ?>)"><i class="fa fa-times"></i> Delete</button></td>
                            <td style="display: none;"><?= $key->email; ?></td>
                            <td style="display: none;">Rp <?= number_format($key->saldo); ?></td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="dist/assets/libs/jquery/jquery.min.js"></script>
<script>
    function send() {
        $("#success").hide();
        $("#email").html();
        $("#error").hide();
        var data = $('#form-add').serialize();
        $.ajax({
            url: 'users/add',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error == false) {
                    $("#success").show();
                    $("#email").html(r.email);
                    $("#form-add")[0].reset();
                } else {
                    $("#error").show();
                }
            }
        });
    }
    function deletes(id) {
        var r = confirm("Do you want to delete user with user id "+id);
        if (r == true) {
            $.ajax({
            url: 'users/delete',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (r) {
                if (r.error == false) {
                    location.reload();
                } else {
                    $("#error").show();
                }
            }
            });
        } else {
            
        }
    }
</script>