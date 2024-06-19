<div class="showAttendence">

    <div class="container">
        <br>

        <div class="attendenceTable" style="display: block;">
            <div class="header">
                <i class='bx bx-credit-card'></i>
                <h3>Teachers Salary</h3>

                <!--
                    <a href="#" class="excel">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            <span>EXCEL</span>
                    </a>

                    <a href="#" class="report">
                        <i class='bx bxs-file-pdf'></i>
                        <span>PDF</span>
                    </a> 
                -->

                <div class="_flex-container">
                    <input class="form-control me-2" type="search" placeholder="Search" style="max-width: 225px;height: 40px;" id="search-teacher-name" aria-label="Search">
                    <button class="btn btn-success" type="button" id="searchTeacherByNameBtn" disabled><i class='bx bx-search-alt'></i></button>
                </div>

            </div>
            <hr class="text-danger">

            <div class="students-table">
                <table class="remove-cursor-pointer">
                    <thead>
                        <tr>
                            <th scope="col" class="thead col-2">#</th>
                            <th scope="col" class="thead col-3">Teacher ID</th>
                            <th scope="col" class="thead col-5">Name</th>
                            <th class="thead col-2">Action</th>
                        </tr>
                    </thead>

                    <tbody id="teacher-salary-table-body">
                        <tr>
                            <td class="pe-1">&nbsp;&nbsp;1&nbsp;&nbsp;</td>
                            <td>T1703574415</td>
                            <td class="user">

                                <img src="../teacherUploads/1701517055user.png">
                                <p>Shreya mishra</p>

                            </td>
                            <td class="flex-center p-3">
                                <div class="btn-group-vertical" role="group" aria-label="Large button group">


                                    <button type="button p-0 m-0" class="btn content-center btn-outline-success text-center" data-bs-toggle="modal" data-bs-target="#show-monthly-salary">

                                        40,000
                                        <i class='bx ms-1 bx-show-alt'></i>
                                    </button>


                                </div>

                            </td>

                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="dataNotAvailable" style="display: block;">

                <div class="_flex-container box-hide">

                    <div class="no-data-box">
                        <div class="no-dataicon">
                            <i class='bx bx-data'></i>
                        </div>
                        <p>No Data</p>
                    </div>
                </div>

            </div>



        </div>
        <hr class="text-danger">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary" id="salary-prev-btn">prev</button>
                <a class="btn btn-secondary disabled" role="button" aria-disabled="true" id="salary-page-number">1</a>
                <button type="button" class="btn btn-secondary" id="salary-next-btn">next</button>
            </div>
        </div>


    </div>


</div>






<!-- Modal -->
<div class="modal fade" id="show-monthly-salary" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>

                <h1 class="modal-title fs-5" id="staticBackdropLabel">Shubham kumar</h1>
                <small style="font-size : small;">T2342342342</small>
                </div>
                
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <div class="modal-body">

                <table class="table table-stripped">
                    <thead class="table-dark">
                        <tr>

                            <th scope="col">Month</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Bonus</th>
                            <th scope="col">Advance</th>
                            <th scope="col">Pay</th>
                        </tr>
                    </thead>
                    <tbody class="no-hover">
                        <tr>
                            <td class="p-1 m-0">Jan</td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="text" value="45,000" style="max-width: 100px;" disabled>
                            </td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="number" value="2000" style="max-width: 100px;" disabled>
                            </td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="number" value="3000" style="max-width: 100px;" disabled>
                            </td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="text" value="50,000" style="max-width: 120px;" disabled>

                            </td>
                        </tr>


                        <tr>
                            <td class="p-1 m-0">Feb</td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="text" value="45,000" style="max-width: 100px;" disabled>
                            </td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="number" value="2000" style="max-width: 100px;" min="0" oninput="validity.valid||(value='');" placeholder="-">
                            </td>
                            <td class="p-1 m-0">
                                <input class="form-control tableInput srartTime_" type="number" value="2000" style="max-width: 100px;" min="0" oninput="validity.valid||(value='');" placeholder="-">
                            </td>
                            <td class="p-1 m-0">
                                <!-- <input class="form-control tableInput srartTime_" type="number" value="45000" style="max-width: 120px;" disabled> -->

                                <button class="btn btn-success content-center" style="max-width: 100px"><i class="fa-solid fa-question me-1"></i>Paid</button>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>