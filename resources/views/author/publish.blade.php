@extends('layouts.master_user')

@section('content')

<div class="container-fluid create-article-page">
    <div class="row">
        <div class="container">
            <div class="row page-content">
                <div id="loading_div" class="d-none">
                    <img src="{{asset('site/images/Gray_circles_rotate.gif')}}" alt="Loading...">
                </div>
                <form method="POST" id="publish_article" class="col-12" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row page-title">
                        <div class="col-12">
                            <h5 class="title row">Publish your article</h5>
                        </div>
                        <div class="content col-md-9 m-auto">
                            <div class="steps row">
                                <div id="step-1" class="step">
                                    <span class="circle">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">
                                        Login
                                    </span>
                                </div>
                                <span id="line-1" class="line"></span>
                                <div id="step-2" class="step">
                                    <span class="circle">
                                        2
                                    </span>
                                    <span class="text">
                                        Personal Info
                                    </span>
                                </div>
                                <span id="line-2" class="line line-o"></span>
                                <div id="step-3" class="step step-o">
                                    <span class="circle">
                                        3
                                    </span>
                                    <span class="text">
                                        Submit your content
                                    </span>
                                </div>
                            </div>
                            <div class="main-content row">
                                <div id="step_2_form" class="single-form-step col-12">
                                    <input type="hidden" name="step_id" value="2">
                                    <div class="formCounter formCounter-2">
                                        <span class="complete">1</span>
                                        <span>/</span>
                                        <span class="total">5</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 item item-2">
                                            <div class="form-group">
                                                <label>Affiliation</label>
                                                <input type="text" class="enable" name="publish_affiliation" placeholder="Affiliation" value="{{Auth::user()->affiliation}}" required>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-2">
                                            <div class="form-group disabled">
                                                <label>First Name</label>
                                                <input type="text" class="enable" name="publish_firstname" placeholder="First Name" value="{{Auth::user()->first_name}}" required disabled>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-2">
                                            <div class="form-group disabled">
                                                <label>Last Name</label>
                                                <input type="text" class="enable" name="publish_lastname" placeholder="Last Name" value="{{Auth::user()->last_name}}" required disabled>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-2">
                                            <div class="form-group disabled">
                                                <label>Degree</label>
                                                <input type="text" class="enable" name="publish_degree" placeholder="Enter your Degree" value="{{Auth::user()->degree}}" required disabled>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-2">
                                            <div class="form-group disabled">
                                                <label>ORCID Number</label>
                                                <input type="text" class="enable" name="publish_orcid" placeholder="ORCID Number" value="{{Auth::user()->ORCID_number}}" required disabled>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="step_3_form" class="d-none single-form-step col-12">
                                    <input type="hidden" name="step_id" value="3">
                                    <div class="formCounter formCounter-3">
                                        <span class="complete">1</span>
                                        <span>/</span>
                                        <span class="total">5</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 item item-3 addAuthor">
                                            <div class="form-group authors">
                                                <label>Add Authors</label>
                                                <div class="single-author">
                                                    <div class="single-author-row"></div>
                                                    <div class="single-author-inputs">
                                                        <input type="text" class="add-author" name="publish_addAuthorName[]" placeholder="Author Name">
                                                        <input type="text" class="add-author" name="publish_addAuthorTitle[]" placeholder="Author Title">
                                                        <input type="text" class="add-author" name="publish_addAuthorAffiliation[]" placeholder="Affiliation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vMsg"></div>
                                            <div class="buttons">
                                                <button type="button" class="btn btn-primary save-authors enable-next">Save</button>
                                                <button type="button" class="btn btn-primary edit-authors disable-next d-none">Edit</button>
                                                <button type="button" class="btn btn-secondary add-another-author">
                                                    <img src="{{asset('site/images/icons/add-icon.png')}}" alt="+ ">
                                                    <span>Add another author</span>
                                                </button>
                                                <button type="button" class="btn btn-secondary remove-author d-none">
                                                    <img src="{{asset('site/images/icons/add-icon.png')}}" alt="- ">
                                                    <span>Remove author</span>
                                                </button>
                                                <button type="button" class="btn btn-skip enable-next ml-auto">Skip</button>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-3">
                                                <div class="form-group disabled">
                                                    <label>Article Title</label>
                                                    <input type="text" class="enable-next input" name="publish_title" placeholder="Title" required disabled>
                                                    <span class="validationMsg"></span>
                                                </div>
                                            </div>
                                        <div class="col-12 item item-3">
                                            <div class="form-group disabled">
                                                <label>Article Type</label>
                                                <select name="articleType" class="selectpicker enable enable-next select" disabled>
                                                    <option value="" selected disabled>Select Type</option>
                                                    <option value="chemistry">Chemistry</option>
                                                    <option value="energy">Energy</option>
                                                    <option value="dentistry">Dentistry</option>
                                                    <option value="biomedicine">Biomedicine</option>
                                                    <option value="education">Education</option>
                                                </select>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-3">
                                            <div class="form-group disabled">
                                                <label>Corresponding Author</label>
                                                <input type="text" class="enable-next input" name="publish_corresponding" placeholder="Email" required disabled>
                                                <span class="validationMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 item item-3 article-content-item">
                                            <div class="form-group disabled">
                                                <label>Article Content</label>
                                                <div class="rich-text-editor">
                                                    <textarea class="summernote" name="abstract" placeholder="Abstract" required></textarea>
                                                    <span class="disable rich-disable"></span>
                                                </div>
                                                <textarea name="keywords" class="enable-text" placeholder="Keywords" disabled required></textarea>
                                                <div class="rich-text-editor">
                                                    <textarea class="summernote" name="intro" placeholder="Intro" required></textarea>
                                                    <span class="disable rich-disable"></span>
                                                </div>
                                                <div class="rich-text-editor">
                                                    <textarea name="additionalInfo" class="summernote" placeholder="Additional Info" required></textarea>
                                                    <span class="disable rich-disable"></span>
                                                </div>
                                                <div class="rich-text-editor">
                                                    <textarea name="Reference" class="summernote" placeholder="Reference" required></textarea>
                                                    <span class="disable rich-disable"></span>
                                                </div>
                                                <div class="file-upload">
                                                    <span class="input-placeholder">Upload Word File</span>
                                                    <input type="file" class="enable-content" accept=".docx" name="wordFile" placeholder="Upload Word File" required disabled>
                                                    <img src="{{asset('site/images/icons/upload.png')}}" alt="">
                                                </div>
                                                <div class="file-upload">
                                                    <span class="input-placeholder">Upload Figures</span>
                                                    <input type="file" class="enable-content" accept=".jpg, .jpeg" name="figures" placeholder="Upload Figures" required disabled>
                                                    <img src="{{asset('site/images/icons/upload.png')}}" alt="">
                                                </div>
                                                <div class="file-upload">
                                                    <span class="input-placeholder">Upload Table Excel Sheet</span>
                                                    <input type="file" class="enable-content" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="excelSheet" placeholder="Upload Table Excel Sheet" required disabled>
                                                    <img src="{{asset('site/images/icons/upload.png')}}" alt="">
                                                </div>
                                                <div class="file-upload">
                                                    <span class="input-placeholder">Upload Author Conflict</span>
                                                    <input type="file" class="enable-content" accept=".pdf, .jpg, .jpeg" name="authorConflict" placeholder="Upload Author Conflict" required disabled>
                                                    <img src="{{asset('site/images/icons/upload.png')}}" alt="">
                                                </div>
                                                <div class="text-and-file">
                                                    <div class="text col-md-6 col-sm-12">
                                                        <textarea class="enable-text" name="financialDisclosure" placeholder="Financial Disclosure" disabled required></textarea>
                                                    </div>
                                                    <div class="file-upload col-md-6 col-sm-12">
                                                        <span class="input-placeholder">Upload Financial Disclosure</span>
                                                        <input type="file" class="enable-content" accept=".pdf" name="financial" placeholder="Upload Financial Disclosure" required disabled>
                                                        <img src="{{asset('site/images/icons/upload.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <textarea class="enable-text" name="ethicsCommunity" placeholder="Ethics Community" disabled required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="step_2_buttons" class="button-container button-container-2 row">
                                <a href="/" class="btn btn-secondary">Cancel</a>
                                <button type="button" class="btn btn-primary action-btn" id="toStep3" disabled>Next</button>
                            </div>
                            <div id="step_3_buttons" class="button-container button-container-3 row d-none">
                                <button type="button" class="btn btn-secondary" id="toStep2">back</button>
                                <button type="submit" class="btn btn-primary action-btn" disabled>Submit Article</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.inc.publish_modal')
@endsection
@section('scripts')
<script>
    $('#publish_article').on('submit' , (e) => {
        e.preventDefault();

        $('#confirmPublishModal').modal('show');

        $('#publish_btn').click(function () {

            $('#confirmPublishModal').modal('hide');

            $('#loading_div').removeClass('d-none');

            var form = $('#publish_article')[0];
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '/publish-article',
                data: formData,
                contentType: false,
                cache: false, 
                processData: false,
                success: function success(response) {
                    console.log(response);

                    if(response == 'success'){
                        // form.trigger("reset");
                        $('#loading_div').addClass('d-none');
                        $('#thanksFormModal').modal('show');
                        $('#thanksFormModal').on('hidden.bs.modal', function (e) {
                            location.reload();
                        })
                        setTimeout(function () {
                            $('#thanksFormModal').modal('hide');
                            location.reload();
                        }, 3000);
                    }
                    
                },
                error: function error(e) {
                    console.log(e);
                    $('#errorModal').modal('show');
                    setTimeout(function () {
                        $('#errorModal').modal('hide');
                    }, 3000);
                }
            });
        });
    });
</script>
@endsection