<div class="col-md-4">
    <div class="alert alert-info">
        <strong>How To Withdraw.</strong> <br>Fill all form with that required, fill <i>User ID/Email</i> with User ID or Email user, fill amount with number, then confirm with your password to complete the transaction for withdraw.
    </div>
    <form class="form-horizontal form-bordered" role="form" id="form-withdraw">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Withdraw Form</h4>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger" id="error" style="display: none;">
                    <strong>ERROR <i class="fa fa-times"></i></strong> : Failed to deposit
                </div>
                <div class="alert alert-danger" id="empty" style="display: none;">
                    <strong>ERROR <i class="fa fa-times"></i></strong> : There are empty field
                </div>
                <div class="alert alert-danger" id="password" style="display: none;">
                    <strong>ERROR <i class="fa fa-times"></i></strong> : Password wrong
                </div>
                <div class="alert alert-danger" id="saldo" style="display: none;">
                    <strong>ERROR <i class="fa fa-times"></i></strong> : Insufficient balance
                </div>
                <div class="alert alert-success" id="success" style="display: none;">
                    <strong>SUCCESS <i class="fa fa-check"></i></strong> : Success withdraw <i id="amount"></i> to <i id="name"></i>
                </div>
                <div class="form-group">
                    <label for="inputEmail4" class="col-sm-3 control-label">User ID/Email</label>
                    <div class="col-sm-9" id="frmClass">
                        <input type="text" class="form-control" name="id" id="email-box" placeholder="User ID/Email">
                        <div id="suggesstion-box"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword4" class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="amount" placeholder="Amount">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFirstName4" class="col-sm-3 control-label">User Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" placeholder="Your Password">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-offset-7 col-sm-5">
                        <button type="button" onclick="send()" class="btn btn-success"><i class="fa fa-check"></i> Send</button>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<div class="col-md-8">
<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Withdraw List</h4>
        </div>
        <div class="panel-body">
            <table id="table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th width="7%">No.</th>
                        <th width="13%">Invoice</th>
                        <th width="">User</th>
                        <th width="20%">Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($data as $key): ?>
                        <tr class="odd gradeX">
                            <td class="center"><?= $no; ?></td>
                            <td><label class="label label-info"><?= $key->invoice; ?></label></td>
                            <td><?= $this->database->getwhere('data_user', array('user_id' => $key->iduser))->name; ?></td>
                            <td>Rp <?= number_format($key->amount); ?></td>
                            <td><?= $key->date; ?></td>
                            <td><label class="label label-success">Complete</label></td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="dist/assets/libs/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#email-box").on('input', function(){
            $.ajax({
            type: "POST",
            url: "deposit/search",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#email-box").css("background","#FFF");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#email-box").css("background","#FFF");
            }
            });
        });
    });
    //To select country name
    function selects(val) {
    $("#email-box").val(val);
    $("#suggesstion-box").hide();
    }
    function send() {
        $("#success").hide();
        $("#name").html();
        $("#amount").html();
        $("#error").hide();
        $("#empty").hide();
        $("#saldo").hide();
        $("#password").hide();
        var data = $('#form-withdraw').serialize();
        $.ajax({
            url: 'withdraw/add',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error == false) {
                    $("#success").show('slow');
                    $("#name").html(r.name);
                    $("#amount").html(r.amount);
                    setTimeout(function () {
                            location.reload();
                        }, 3000);
                } else if (r.msg == 'fail') {
                    $("#error").show('slow');
                } else if (r.msg == 'empty') {
                    $("#empty").show('slow');
                } else if (r.msg == 'password') {
                    $("#password").show('slow');
                } else if (r.msg == 'saldo') {
                    $("#saldo").show('slow');
                }
            }
        });
    }
</script>