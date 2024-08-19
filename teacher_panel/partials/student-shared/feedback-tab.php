<div class="showAttendence feedback">
    <br>
    <div class="header">
    <i class='bx bx-chat' ></i>

        <h3>Student Feedback</h3>
    </div>
    

    <hr>
    <br>
    <div class="container" style="display: flex;">

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label px-1">&nbsp;Class&nbsp; </label>
            </div>
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="feedback-search-class">
                    <option value="12c">12 (Commerce)</option>
<option value="11c">11 (Commerce)</option>
<option value="12s">12 (Science)</option>
<option value="11s">11 (Science)</option>
<option value="10">10</option>
<option value="9">9</option>
<option value="8">8</option>
<option value="7">7</option>
<option value="6">6</option>
<option value="5">5</option>
<option value="4">4</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
<option value="pg">Nursery</option>
<option value="lkg">lkg</option>
<option value="ukg">ukg</option>
                </select>
            </div>
        </div>


    </div>
    <br>
    <div class="container" style="display: flex;">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label">Section </label>
            </div>
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="feedback-search-section">
                    <option selected>A</option>
                    <option>B</option>
                    <option>C</option>
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="container" style="display: flex;">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label">Student </label>
            </div>
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="feedback-search-student">

                </select>
                <div class="invalid-feedback" id="select-student-first">
                    Please select student!
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <a class="find" onclick="findStudentFeedback()">
            <i class='bx bx-search-alt'></i>
            <span>Find</span>
        </a>
    </div>
    <br>
    <hr>

    <div class="container">

        <div class="student-feedback">

            <div class="row">
                <div class="col-12 col-md-4" style="max-height: 400px;">

                    <div class="card border-0 w-100 rounded-0 my-3" style="width: 12rem;">

                        <div class="card-header" id="settings-card-header">
                            <h5 class="card-title mb-0">Student</h5>
                        </div>

                        <div class="continer">
                            <div class="content-center mt-4 card-image-box">

                                <img src="../images/user.png" class="card-img-top" alt="student-image" id="feedback-student-pic">
                            </div>

                        </div>
                        <div class="card-body mt-3">
                            <!-- <h5 class="card-title">Card title</h5> -->
                            <div class="mb-4 text-break"><b class="fs-5 text-break feedback-student-name">Shubham kumar</b></div>
                            <div class="fs-6 mb-0 text-break" id="feedback-student-id">
                                <b>ID</b> - <div></div>
                            </div>
                            <div class="fs-6 mb-0 text-break" id="feedback-student-phone">
                                <b>Phone</b> - <div></div>
                            </div>
                            <div class="fs-6 text-break" id="feedback-student-dob">
                                <div></div>
                            </div>
                            <input type="hidden" name="student-id" value="" id="reciver-student-id">

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-8 d-flex mt-3 p-0 justify-content-center">

                    <div class="row w-100" >

                        <div class="container">

                            <div class="card border-0 rounded-0 card-messages mt-3" style="width: 100%;">
                                <div class="mt-3">   


                                    <h6 class="ms-2">Feedbacks</h6>

                                    <div class="messages-box" id="feedback-message-box">

                                    </div>
                                </div>

                            </div>
                            <div class="card rounded-0 mt-3" style="background: none;">

                                <div class="row">
                                    <div class="d-flex" role="search">
                                        <textarea name="feedback-textarea" cols="30" rows="2" class="form-control me-2" style="resize: none;" id="feedback-msg"></textarea>

                                        <button class="btn btn-outline-success" id="send-feedback-btn">
                                            <i class='bx bx-send' style="font-size: 35px;" class="text-center justify-content-center"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="empty-message-alert">
                                        Please enter message!
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

        <div class="dataNotAvailable" id="not-selected-feedbacks" style="display:block">
            <div class="_flex-container box-hide">
                <div class="no-data-box">
                    <div class="no-dataicon">
                        <i class='bx bxs-chat'></i>
                    </div>
                    <p class="text-center">Send Feedbacks</p>
                </div>
            </div>

        </div>




    </div>


</div>