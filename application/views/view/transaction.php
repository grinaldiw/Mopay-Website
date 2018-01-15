<div class="col-md-12">
    <div class="alert alert-success">
        <strong>List Transaction By All User.</strong> <br>Click <i class="fa fa-plus"></i> button to see detail like transfer amount and transaction date.
    </div>
<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Transaction List</h4>
        </div>
        <div class="panel-body">
            <table id="table-hidden-row-details" class="table table-striped">
                <thead>
                    <tr>
                        <th width="7%">No.</th>
                        <th width="13%">Invoice</th>
                        <th width="">Sender</th>
                        <th width="">Receiver</th>
                        <th>Status</th>
                        <th style="display: none;">Platform(s)</th>
                        <th style="display: none;">Engine version</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($data as $key): ?>
                        <tr class="odd gradeX">
                            <td class="center"><?= $no; ?></td>
                            <td><label class="label label-info"><?= $key->invoice; ?></label></td>
                            <td><?= $this->database->getwhere('data_user', array('user_id' => $key->send))->name; ?></td>
                            <td><?= $this->database->getwhere('data_user', array('user_id' => $key->receive))->name; ?></td>
                            <td><label class="label label-success">Complete</label></td>
                            <td style="display: none;"><?= $key->date; ?></td>
                            <td style="display: none;">Rp <?= number_format($key->amount); ?></td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>