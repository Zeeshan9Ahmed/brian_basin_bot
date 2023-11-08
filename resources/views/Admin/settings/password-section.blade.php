<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Password</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="" role="form" class="ajaxForm validate-form" method="post" action="{{ url("admin/settings") }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-11 col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputCurrentPassword">Current Password<span
                                        class="text-danger">*</span></label>
                            <input type="password" class="form-control validate[required]"
                                   name="current_password"
                                   id="exampleInputCurrentPassword" placeholder="Enter Your Current Password">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password (Minimum 8 Character)<span
                                        class="text-danger">*</span></label>
                            <input type="password" class="form-control validate[required,minSize[8],maxSize[50]]" name="password"
                                   id="password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password<span
                                        class="text-danger">*</span></label>
                            <input type="password" class="form-control validate[required,equals[password]]"
                                   name="password_confirmation"
                                   id="confirm_password" placeholder="Confirm Password">
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <input type="hidden" name="update_section" value="update_password_information">
                <input type="hidden" name="uID"
                       value="<?php echo base64_encode(auth()->user()->id); ?>"/>
                <button type="submit" class="btn btn-primary">SAVE</button>
                <a href="{{ url("admin/dashboard") }}" class="btn btn-info">BACK</a>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->