<!-- START ARTICLE REQUEST MODAL -->

<div class="modal fade" id="dataEntryArticleRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="publish-article" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="article_id" name="article_id" value="">
            <div class="modal-content" id="article_body">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLongTitle">New Article Request</h5>
                    <div class="action-btns">
                        @if($_SERVER['REQUEST_URI'] != '/data_entry/finished_articles')
                        <button class="modal-btn edit-btn" data-placement="bottom" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="submit" class="modal-btn save-btn d-none" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fas fa-save"></i>
                        </button>
                        <button class="modal-btn cancel-btn d-none" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                            <i class="far fa-window-close"></i>
                        </button>
                        @endif
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="show_note" class="row d-none">
                            <div class="col-12">
                                <div class="row">
                                    <div class="separator">
                                        <p>Admin Notes</p>
                                        <span class="line"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 admin-notes">
                                <p id="admin_notes">Lorem Ipsum</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="separator">
                                        <p>Personal Info</p>
                                        <span class="line"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="item col-12">
                                        <h5 class="title">Affiliation</h5>
                                        <p class="text editable editable-text" id="affiliation_text">Lorem Ipsum</p>
                                        <input type="text" class="d-none edit_field edit_field-text" id="article-affiliation" name="publish_affiliation" value="Lorem Ipsum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="item col-12">
                                        <h5 class="title">Degree</h5>
                                        <p class="text editable editable-text" id="degree_text">Lorem Ipsum</p>
                                        <input type="text" class="d-none edit_field edit_field-text" id="article-degree" name="publish_degree" value="Lorem Ipsum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="item col-12">
                                        <h5 class="title">First Name</h5>
                                        <p class="text editable editable-text" id="firstname_text">Lorem Ipsum</p>
                                        <input type="text" class="d-none edit_field edit_field-text" id="article-firstName" name="publish_firstname" value="Lorem Ipsum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="item col-12">
                                        <h5 class="title">Corresponding Author</h5>
                                        <p class="text editable editable-text" id="correspondingAuthor_text">Lorem Ipsum</p>
                                        <input type="text" class="d-none edit_field edit_field-text" id="article-corresponding_author" name="publish_corresponding" value="Lorem Ipsum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="item col-12">
                                        <h5 class="title">Last Name</h5>
                                        <p class="text editable editable-text" id="lastname_text">Lorem Ipsum</p>
                                        <input type="text" class="d-none edit_field edit_field-text" id="article-lastName" name="publish_lastname" value="Lorem Ipsum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 article-details">
                                <div class="row details-tabs">
                                    <ul class="nav nav-pills" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-author_info-tab" data-toggle="pill" href="#pills-author_info" role="tab" aria-controls="pills-author_info" aria-selected="true">Author Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-article_info-tab" data-toggle="pill" href="#pills-article_info" role="tab" aria-controls="pills-article_info" aria-selected="false">Article Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-content-tab" data-toggle="pill" href="#pills-content" role="tab" aria-controls="pills-content" aria-selected="false">Article Content</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-files-tab" data-toggle="pill" href="#pills-files" role="tab" aria-controls="pills-files" aria-selected="false">Article Files</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row details-panes">
                                    <div class="tab-content col-12">
                                        <div class="row tab-pane fade show active" id="pills-author_info" role="tabpanel" aria-labelledby="pills-author_info-tab">
                                            <div class="single-author-wrapper col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="item col-12">
                                                                <h5 class="title">Author Name</h5>
                                                                <p class="text editable editable-text author_name">Lorem Ipsum</p>
                                                                <input type="text" class="d-none edit_field edit_field-text author_name_input" name="article-authorName[]" value="Lorem Ipsum" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="item col-12">
                                                                <h5 class="title">Author Title</h5>
                                                                <p class="text editable editable-text author_title">Lorem Ipsum</p>
                                                                <input type="text" class="d-none edit_field edit_field-text author_title_input" name="article-authorTitle[]" value="Lorem Ipsum" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="item col-12">
                                                                <h5 class="title">Affiliation</h5>
                                                                <p class="text editable editable-text author_affiliation">Lorem Ipsum</p>
                                                                <input type="text" class="d-none edit_field edit_field-text author_affiliation_input" name="article-authorAffiliation[]" value="Lorem Ipsum" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row tab-pane fade" id="pills-article_info" role="tabpanel" aria-labelledby="pills-article_info-tab">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Article Type</h5>
                                                        <p class="text editable editable-select" id="details_type_text">Lorem Ipsum</p>
                                                        <select name="articleType" id="articleType" class="selectpicker d-none edit_field edit_field-select" required>
                                                            <option value="chemistry">Chemistry</option>
                                                            <option value="energy">Energy</option>
                                                            <option value="dentistry">Dentistry</option>
                                                            <option value="biomedicine">Biomedicine</option>
                                                            <option value="education">Education</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row tab-pane fade" id="pills-content" role="tabpanel" aria-labelledby="pills-content-tab">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Abstract</h5>
                                                        <p class="text editable editable-rich" id="details_abstract_text">
                                                            incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-rich" id="article-abstract" name="abstract" value="text" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Keywords</h5>
                                                        <p class="text editable editable-area" id="details_keywords_text">
                                                            <span class="keyword">Keyword</span>
                                                            <span class="keyword">Keyword</span>
                                                            <span class="keyword">Keyword</span>
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-area" id="article-keywords" name="keywords" value="" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Intro</h5>
                                                        <p class="text editable editable-rich" id="details_intro_text">
                                                            incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-rich" id="article-intro" name="intro" value="" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Additional Info</h5>
                                                        <p class="text editable editable-rich" id="details_addInfo_text">
                                                            incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-rich" id="article-additional_info" name="additionalInfo" value="" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Reference</h5>
                                                        <p class="text editable editable-rich" id="details_reference_text">
                                                            incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-rich" id="article-reference" name="Reference" value="" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row tab-pane fade" id="pills-files" role="tabpanel" aria-labelledby="pills-files-tab">
                                                <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Word File</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" id="word_file" class="btn btn-primary download-btn">Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" id="article-word-file" name="wordFile" value="Lorem Ipsum">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Figure</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" id="figure" class="btn btn-primary download-btn" download>Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" id="article-figure-file" name="figures" value="Lorem Ipsum">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Table Excel Sheet</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" id="excel_sheet" class="btn btn-primary download-btn">Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" id="article-sheet-file" name="excelSheet" value="Lorem Ipsum">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Author Conflict</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" id="author_conflict" class="btn btn-primary download-btn">Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" id="article-conflict-file" name="authorConflict" value="Lorem Ipsum">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Financial Disclosure</h5>
                                                        <p class="text editable editable-area" id="article-financial-text">
                                                            incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-area" id="financial_disclosure" name="financialDisclosure" value="" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Financial Disclosure file</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" id="financial_disclosure_file" class="btn btn-primary download-btn">Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" id="article-finance-file" name="financial" value="Lorem Ipsum">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item col-12">
                                                        <h5 class="title">Ethics Community</h5>
                                                        <p class="text editable editable-area" id="details_ethics_text">
                                                            incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.incididunt ut labore et dolore magna aliqua. ... The first word, “Lorem,” isn't even a word; instead it's a piece of the word “dolorem,” meaning pain, suffering, or sorrow.
                                                        </p>
                                                        <textarea class="d-none edit_field edit_field-area" id="article-ethics" name="ethicsCommunity" value="" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- T --}}
                                            {{-- <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Some File</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" class="btn btn-primary download-btn">Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" name="article-file" value="Lorem Ipsum" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="item download col-12">
                                                        <h5 class="title">Some File</h5>
                                                        <p class="text editable editable-file">
                                                            <a href="#" class="btn btn-primary download-btn">Download</a>
                                                        </p>
                                                        <input type="file" class="d-none edit_field edit_field-file" name="article-file" value="Lorem Ipsum" required>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($_SERVER['REQUEST_URI'] != '/data_entry/finished_articles')
                <div class="modal-footer">
                    <button type="submit" class="btn reject-btn article_to_reject">Save Changes</button>
                    <button onclick="sendToAdmin()" type="button" class="btn approve-btn article_to_approve">Send to admin to publish</button>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- END ARTICLE REQUEST MODAL -->



<!-- START CONFIRMATION MODAL -->

<div class="modal fade" id="confirmDeleteJournalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h5>Are you sure you want to delete this Journal !</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="deleteJournal(item)">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- END CONFIRMATION MODAL -->