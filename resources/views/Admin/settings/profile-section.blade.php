<div class="card">
    <div class="card-header">
        <h3 class="card-title">Update Your Information</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form role="form" class="ajaxForm validate-form" method="post" action="{{ url("admin/settings") }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleFirstname">First Name <span
                                class="text-danger">*</span></label>
                    <input type="text" class="form-control validate[required,custom[onlyLetterSp],maxSize[50]]" name="first_name"
                           id="exampleFirstname" placeholder="Enter First Name"
                           value="{{ auth()->user()->first_name }}">
                </div>
                <div class="form-group">
                    <label for="exampleLastname">Last Name <span
                                class="text-danger">*</span></label>
                    <input type="text" class="form-control validate[required,custom[onlyLetterSp],maxSize[50]]" name="last_name"
                           id="exampleLastname" placeholder="Enter Last Name"
                           value="{{ auth()->user()->last_name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control validate[required,custom[email],maxSize[50]]"
                           name="email" id="exampleInputEmail1" placeholder="Enter email"
                           value="{{ auth()->user()->email }}" readonly>
                </div>
                {{--
                    <div class="form-group">
                    <label for="exampleInputPhone">Profile Image <span class="text-danger"></span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input sizetype-validate" id="exampleInputFile" name="profile_image" data-label="Recommended Banner Image (420w x 128h)">
                            <label class="custom-file-label" for="exampleInputFile">Recommended Profile Image (160w x 160h)</label>
                        </div>
                    </div>
                    <i class="text-warning">Picture size should be less than 4MB</i>
                </div>    
                --}}
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <input type="hidden" name="update_section" value="update_profile_information">
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