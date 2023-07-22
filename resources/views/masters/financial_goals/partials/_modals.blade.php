<div class="modal fade" id="removeGoalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="examplePostModalLabel">Remove Goal</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="removeGoalForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    This goal will be removed. Are you sure you want to remove?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Remove Goal</button>
                </div>
            </form>
        </div>
    </div>
</div>
