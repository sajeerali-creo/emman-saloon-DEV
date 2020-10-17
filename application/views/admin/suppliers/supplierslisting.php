<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo count($supplierRecords); ?>&nbsp;
                    <span class="text-gray-600">Suppliers</span>
                </h6>
                <div>
                    <a href="<?php echo base_url(); ?>securepanel/add-supplier" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"> <i class="fas fa-plus"></i>&nbsp;Add New Suppliers</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Supplier Name</th>
                                <th>Catogories</th>
                                <th>Location</th>
                                <th>Post Code</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Fax</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if(!empty($supplierRecords)){
                                foreach($supplierRecords as $record){
                                    ?><tr class="row_<?php echo $record->id; ?>">
                                        <th><?php echo $record->title; ?></th>
                                        <th><?php echo $record->category; ?></th>
                                        <th><?php echo $record->city; ?>, <?php echo $record->country; ?></th>
                                        <th><?php echo $record->postcode; ?></th>
                                        <th><?php echo $record->phone; ?></th>
                                        <th><?php echo $record->email; ?></th>
                                        <th><?php echo $record->fax; ?></th><?php

                                        if($record->status == 'AC'){
                                            ?><th class="text-success">In Stock</th><?php
                                        }
                                        else{
                                            ?><th class="text-danger">Out of Stock</th><?php
                                        }

                                        ?><th class="text-right">
                                            <a href="<?php echo base_url().'securepanel/detail-supplier/'.$record->id; ?>" class="btn btn-light">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url().'securepanel/edit-supplier/'.$record->id; ?>" class="btn btn-light">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#delete-supplier"
                                                class="btn btn-light deleteSupplier" data-recordid="<?php echo $record->id; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </th>
                                    </tr><?php
                                }
                            }
                        ?></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


</div>
<!-- /.container-fluid -->

<!-- delet services -->
<div class="modal fade" id="delete-supplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
                <input type="hidden" name="hdDeleteRecordId" id="hdDeleteRecordId">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-supplier-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>