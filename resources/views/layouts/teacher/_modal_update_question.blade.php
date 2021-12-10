<div class="modal fade" id="modal-update-question" tabindex="-1" role="dialog" aria-labelledby="modal-update-question-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Ubah Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetValue()">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="question_id">
                <label for="name" class="col-form-label">Pertanyaan</label>
                <textarea type="text" class="form-control text-dark" name="update_question" placeholder="Masukan pertanyaan"></textarea>
                <label for="name" class="col-form-label">Penjelasan</label>
                <textarea type="text" class="form-control text-dark" name="update_explanation" placeholder="Masukan pertanyaan"></textarea>
                <p class="mb-1 mt-2">Jawaban</p>
                <div class="row m-auto">
                    <div class="col-12 form-check d-flex align-content-center">
                        <input class="form-check-input" type="radio" name="update_activity_answer" id="i-update-answer-1" value="A">
                        <label class="form-check-label" for="i-update-answer-1">
                            <textarea class="col-11 mb-1 form-control" rows=1 name="update_answer_1" placeholder="Jawaban A"></textarea>
                        </label>
                    </div>
                    <div class="col-12 form-check">
                        <input class="form-check-input" type="radio" name="update_activity_answer" id="i-update-answer-2" value="B">
                        <label class="form-check-label" for="i-update-answer-2">
                            <textarea class="col-11 mb-1 form-control" rows=1 name="update_answer_2" placeholder="Jawaban B"></textarea>
                        </label>
                    </div>
                    <div class="col-12 form-check">
                        <input class="form-check-input" type="radio" name="update_activity_answer" id="i-update-answer-3" value="C">
                        <label class="form-check-label" for="i-update-answer-3">
                            <textarea class="col-11 mb-1 form-control" rows=1 name="update_answer_3" placeholder="Jawaban C"></textarea>
                        </label>
                    </div>
                    <div class="col-12 form-check">
                        <input class="form-check-input" type="radio" name="update_activity_answer" id="i-update-answer-4" value="D">
                        <label class="form-check-label" for="i-update-answer-4">
                            <textarea class="col-11 mb-1 form-control" rows=1 name="update_answer_4" placeholder="Jawaban D"></textarea>
                        </label>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-update-activity" onclick="updateQuestionFull()">Ubah</button>
        </div>
        </div>
    </div>
</div>
</div>