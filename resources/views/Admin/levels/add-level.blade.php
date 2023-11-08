
@extends('layout.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Level</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Level</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <form class="ajaxForm" role="form" id="ur-form" action="{{ route('admin.level.create') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div class="card-body append">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="genere"> Genere <span class="text-danger">*</span></label>
                                        <select name="genere" class="form-control" required>
                                            <option value="">--Select Genere</option>
                                            @foreach($generes as $genere)
                                            <option value="{{ $genere->id }}">{{$genere->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="file" >Choose file <span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="music" onchange="ValidateSingleInput(this);" id="exampleInputFile" required>
                                                <label for="file">Choose file </label>
                                                <label id="file" class="custom-file-label " for="exampleInputFile">Choose An Audio File</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>

                                            </div>

                                        </div>
                                        <span class="text-danger" id="iamge-validator"> </span>
                                    </div>
                                </div>
                            </div>


                            <div class="test">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Remove</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool delete-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div> 
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> Question <span class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question[1]" class="form-control form-control-sm"  placeholder="Question" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                    <label for="answer"> Answer 1<span class="text-danger">*</span></label>    
                                                    <input type="text" id="answer" name="answers1[]" class="form-control form-control-sm"  placeholder="Answer 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 2<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers1[]" class="form-control form-control-sm"  placeholder="Answer 2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 3<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers1[]" class="form-control form-control-sm"  placeholder="Answer 3" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 4<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers1[]" class="form-control form-control-sm"  placeholder="Answer 4" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="answer"> Correct Answer<span class="text-danger">*</span></label> <br>
                                                    <input type="radio" name="answers1[]" value="0" required> Answer 1 <br>
                                                    <input type="radio" name="answers1[]" value="1"> Answer 2 <br>
                                                    <input type="radio" name="answers1[]" value="2"> Answer 3 <br>
                                                    <input type="radio" name="answers1[]" value="3"> Answer 4
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="test">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Remove</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool delete-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div> 
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> Question <span class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question[2]" class="form-control form-control-sm" placeholder="Question" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 1<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers2[]" class="form-control form-control-sm" placeholder="Answer 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 2<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers2[]" class="form-control form-control-sm" placeholder="Answer 2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 3<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers2[]" class="form-control form-control-sm" placeholder="Answer 3" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 4<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers2[]" class="form-control form-control-sm" placeholder="Answer 4" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="answer"> Correct Answer<span class="text-danger">*</span></label>  <br>
                                                    <input type="radio" name="answers2[]"  value="0" required> Answer 1 <br>
                                                    <input type="radio" name="answers2[]" value="1"> Answer 2 <br>
                                                    <input type="radio" name="answers2[]" value="2"> Answer 3 <br>
                                                    <input type="radio" name="answers2[]" value="3"> Answer 4
                                                </div>
                                            </div>

                                        </div>    
                                    </div>
                                </div>
                            </div>

                            
                            <div class="test">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Remove</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool delete-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div> 
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> Question <span class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question[3]" class="form-control form-control-sm" placeholder="Question" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 1<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers3[]" class="form-control form-control-sm" placeholder="Answer 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 2<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers3[]" class="form-control form-control-sm" placeholder="Answer 2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 3<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers3[]" class="form-control form-control-sm" placeholder="Answer 3" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 4<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers3[]" class="form-control form-control-sm" placeholder="Answer 4" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="answer">Correct Answer<span class="text-danger">*</span></label>   <br>
                                                    <input type="radio" name="answers3[]"  value="0" required> Answer 1 <br>
                                                    <input type="radio" name="answers3[]" value="1"> Answer 2 <br>
                                                    <input type="radio" name="answers3[]" value="2"> Answer 3 <br>
                                                    <input type="radio" name="answers3[]" value="3"> Answer 4
                                                </div>
                                            </div>

                                        </div>  
                                    </div>
                                </div>
                            </div>

                        </div>

                        
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="add-more">Add More</button>
                            <button type="submit" class="btn btn-primary" id="add-level">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
@section('additional_scripts')
<script>
    

    $("#add-more").click(function(){
        var number = $(".test").length+1;
        
            const form = `<div class="test">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Remove</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool delete-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div> 
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> Question <span class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question[${number}]" class="form-control form-control-sm" placeholder="Question" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 1<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm" placeholder="Answer 1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 2<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm" placeholder="Answer 2" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 3<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm" placeholder="Answer 3" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 4<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm" placeholder="Answer 4" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="answer">Correct Answer<span class="text-danger">*</span></label>   <br>
                                                    <input type="radio" name="answers${number}[]" value="0" required> Answer 1 <br>
                                                    <input type="radio" name="answers${number}[]" value="1"> Answer 2 <br>
                                                    <input type="radio" name="answers${number}[]" value="2"> Answer 3 <br>
                                                    <input type="radio" name="answers${number}[]" value="3"> Answer 4
                                                </div>
                                            </div>

                                        </div>    
                                    </div>
                                </div>
                            </div>
             `;
                
				$(".append").append(form);
			});

    
    $(document).on('click', '.delete-row', function(e){
        var divLength = $('.test').length;
        if(divLength > 3){
            $(this).parent().parent().parent().parent().remove();
        }
    });
    // id="add-level"
    // $(document).on('click', '#add-level', function(e) {
    //     e.preventDefault();
    //     console.log('form is prevented')
    // });
var _validFileExtensions = [".mp3", ".mpeg", ".mp4"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    $('#iamge-validator').html("")
                    
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                $('#iamge-validator').html(" Invalid file selected")
                
                
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
@endsection