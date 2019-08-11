<!-- START JOURNAL MODAL -->

<div class="modal fade" id="viewJournalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle">Manage Contact Us Form</h5>
                <button class="delete-modal-btn" data-toggle="modal" data-target="#confirmDeleteJournalModal">
                    <img src="{{asset('admin/images/trash-alt-gray.svg')}}" alt="delete">
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Affiliatin</h5>
                                    <p class="text can-edit" id="affiliatin_text">Lorem Ipsum</p>
                                    <input id="affiliatin_input" name="journal_name" type="text" class="d-none edit-input" value="Lorem Ipsum" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Subject</h5>
                                    <p class="text can-edit" id="subject_text">Lorem Ipsum</p>
                                    <input id="subject_input" name="journal_name" type="text" class="d-none edit-input" value="Lorem Ipsum" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Name</h5>
                                    <p class="text" id="name_text">Lorem Ipsum</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Email</h5>
                                    <p class="text" id="email_text">Lorem Ipsum</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="item col-12">
                                    <h5 class="title">Tell us more details</h5>
                                    <p class="text can-edit" id="details_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <input id="details_input" name="journal_name" type="text" class="d-none edit-input" value="Lorem Ipsum" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END JOURNAL MODAL -->



<!-- START CONFIRMATION MODAL -->

<div class="modal fade" id="confirmDeleteJournalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="journal_id" value="">
                            <h5>Are you sure you want to delete this Journal !</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_journal_btn">Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- END CONFIRMATION MODAL -->