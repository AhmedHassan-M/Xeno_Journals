<!-- START THANKS MODAL -->

<div class="modal fade" id="thanksFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="thanks-container text-center">
                    <p class="icon">
                        <img src="{{asset('site/images/Thanks_Modal.svg')}}">
                    </p>
                    <h2>Thanks</h2>
                    <p class="thanks-text">
                        Your article has been successfully submitted
                    </p>
                    <div class="button">
                        <button class="btn" data-dismiss="modal">Thanks</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END THANKS MODAL -->



<!-- START ERROR MODAL -->

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="error-container text-center">
                    <p class="icon">
                        <span class="i">
                            <i class="fas fa-times"></i>
                        </span>
                    </p>
                    <h2>Error</h2>
                    <p class="error-text">
                        Sorry, the article has not been submitted
                    </p>

                    <div class="button">
                        <button class="btn" data-dismiss="modal">Ok</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- END ERROR MODAL -->



<!-- START CONFIRMATION MODAL -->

<div class="modal fade" id="confirmPublishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="confirm_delete_journal_form" class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h5>Are you sure you want to publish this article ?</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="publish_btn">Publish</button>
            </div>
        </form>
    </div>
</div>

<!-- END CONFIRMATION MODAL -->