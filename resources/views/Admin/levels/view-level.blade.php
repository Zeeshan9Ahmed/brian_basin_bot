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
                        <li class="breadcrumb-item active">Edit Level</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card-default">
                    @if (auth()->user()->role === 'admin' && auth()->user()->can_edit === 1)
                    <div class="card">
                        <button type="button" id="edit-all-btn" style="float: right" class="btn btn-sm btn-success auto-width">Edit</button>
                    </div>
                    @endif
                    <form class="ajaxForm" role="form" id="ur-form" action="{{ route('admin.level.update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div class="card-body append">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="genere"> Genere <span class="text-danger"></span></label>
                                        
                                        <select name="genere" class="form-control" disabled>
                                            <option  value="">--Select Genere</option>
                                            @foreach($generes as $genere)
                                            <option <?php if($response['level']->genere_id==$genere->id) echo 'selected="selected"'; ?> value="{{ $genere->id }}" disabled>{{$genere->name}} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="file">Choose file <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="hidden" name="level_id" value="{{$response['level']->level_id}}" >
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label for="file">Choose file </label>
                                                <label id="file" class="custom-file-label " for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach($response['questions'] as $ques_key => $question)
                            @php 
                            //dd($question,$response['level']->level_id);
                            $val = ++$ques_key;
                            @endphp
                            <div class="test" data-id="{{$question['question_id']}}">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title" disabled>Remove</h3>
                                        <div class="card-tools">
                                            <button type="button" data-id="{{$question['question_id']}}" class="btn btn-tool delete-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                    </div> 
                                    <?php 
                                        // dd($question);
                                     ?>
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> Question <span class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question[{{$val}}]" value="{{$question['question']}}" class="form-control custom form-control-sm" required placeholder="Question">
                                                    <input type="hidden" id="question" name="question_ids[{{$val}}]" value="{{$question['question_id']}}" class="form-control custom form-control-sm" >
                                                </div>
                                            </div>
                                            @foreach($question['ans'] as $index => $answer )
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                    <label for="answer"> Answer 1<span class="text-danger">*</span></label>    
                                                    <input type="text" id="answer" name="answers{{$val}}[]" value="{{$answer}}" class="form-control custom form-control-sm" require placeholder="Answer 1">
                                                    <input type="hidden" id="question" name="answers_ids{{$val}}[]" value="{{$question['ans_key'][$index]}}" class="form-control custom form-control-sm" >

                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="answer"> Correct Answer<span class="text-danger">*</span></label> <br>

                                                    @foreach($question['coor'] as $key => $answer)
                                                                      
                                                    <input type="radio" required class="radio_button" name="answers{{$val}}[]" required @if($answer == '1') checked @endif value="{{$key}}">   Answer {{ ++$key }} <br>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                            

                        </div>

                        
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="add-more">Add More</button>
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                            <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
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
                                            <button type="button" data-id='a' class="btn btn-tool delete-appended-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div> 
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> Question <span class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question[${number}]" class="form-control form-control-sm " required placeholder="Question">
                                                    <input type="hidden" id="question" name="question_ids[${number}]" value="" class="form-control form-control-sm" >

                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 1<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm " required placeholder="Answer 1">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 2<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm " required placeholder="Answer 2">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 3<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm " required placeholder="Answer 3">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                                <div class="form-group">
                                                <label for="answer"> Answer 4<span class="text-danger">*</span></label>    

                                                    <input type="text" id="answer" name="answers${number}[]" class="form-control form-control-sm" required placeholder="Answer 4">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <label for="answer">Correct Answer<span class="text-danger">*</span></label>   <br>
                                                    <input type="radio" name="answers${number}[]" required value="0"> Answer 1 <br>
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
            
        var radios  = document.querySelectorAll(".radio_button");
        
        allDisabled();
    function allDisabled(){
        $('#add-more').hide()
        $('.submit').hide()
        $('#cancel').hide()
        //cancel
        changeRadioButtonStatus(radios,true)

        $(".form-control").prop("disabled", true);
        $(".custom-select").prop("disabled", true);
        var delete_questions = document.querySelectorAll(".delete-row");
        
            [].forEach.call(delete_questions, function(delete_question){
            delete_question.disabled = true;
        });
    }

    $(document).on('click', '#edit-all-btn', function(e){

    $(this).hide();
    document.querySelector("#add-more").style.display = null; // Add More Button
    document.querySelector(".submit").style.display = null; // Add More Button
    document.querySelector("#cancel").style.display = null; // Add More Button
    changeRadioButtonStatus(radios,false)
    
    var delete_questions = document.querySelectorAll(".delete-row");
    [].forEach.call(delete_questions, function(delete_question){
        delete_question.disabled = false;
    });

    var inputs = document.querySelectorAll(".form-control.custom");
    [].forEach.call(inputs, function(input){
        input.disabled = false;
    });

    var selects = document.querySelectorAll(".content.active .custom-select");
    [].forEach.call(selects, function(select){
        select.disabled = false;
    });

});

$(document).on('click','#cancel', ()=>{
    allDisabled()
    $('#edit-all-btn').show();
})

function changeRadioButtonStatus(buttons,status){
    [].forEach.call(buttons, function(button){
            button.disabled = status;
        });
}

    $(document).on('click','.delete-row',function(e)
     {
        if(!confirm("are you sure want to delete it permenantly?"))
        {
            return false;
        }
        that = this;
        id = $(this).data('id');
        e.preventDefault()
        var url = "{{ route('admin.question.delete', ':id') }}";
	    url = url.replace(':id', id);
        
        $.ajax({
            url: url,
            dataType: 'json',
            success: function (response, textStatus, jqXHR) {
                if(response.success == 1){
                    $(that).parent().parent().parent().parent().remove();
                    toastr.success(response.message,'success');                    
                }else{
                    toastr.error(response.message,'error');
                }

            }
        });
    })

   $(document).on('click', '.delete-appended-row', function(e)
   {
        // var div = $('.test');
        // divLength = div.length;
        if(confirm("are you sure?"))
        {
            $(this).parent().parent().parent().parent().remove();
        }
    });
</script>
@endsection