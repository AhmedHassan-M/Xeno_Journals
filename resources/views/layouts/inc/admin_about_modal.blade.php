<!-- START ABOUT MODAL -->

<div class="modal fade" id="addAboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Page</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row page-content">
                        <div class="col-12">
                            <div class="add-page">
                                <h5 class="title">
                                    <input type="text" name="add_title" value="New Page">
                                </h5>
                                <div class="content">
                                    <p>
                                        <textarea name="add_content" class="summernote"></textarea>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel-btn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn save-btn" data-toggle="modal" data-target="#confirmAddAboutModal">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- END ABOUT MODAL -->



<!-- START CONFIRM ADD MODAL -->

<div class="modal fade" id="confirmAddAboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="journal_id" value="">
                            <h5>Are you sure you want to add this page ?</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm_add_btn">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- END CONFIRM ADD MODAL -->



<!-- START CONFIRM DELETE MODAL -->

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                        <input type="hidden" name="delete_page_id" value="">
                            <h5>Are you sure you want to delete this page ?</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm_delete_btn">Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- END CONFIRM DELETE MODAL -->