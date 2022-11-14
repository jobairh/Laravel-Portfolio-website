@extends('layout.app')
@section('content')

    <div id="mainDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <button id="addNewCourseBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

                <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Course Name</th>
                        <th class="th-sm">Course Fee</th>
                        <th class="th-sm">Course Class</th>
                        <th class="th-sm">Course Enroll</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="course_table">


                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div id="loaderDivCourse" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something went wrong!!</h3>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="courseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                                <input id="courseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                                <input id="courseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                                <input id="courseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="courseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                                <input id="courseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                                <input id="courseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="courseAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">

                    <h5 id="courseEditId" class="mt-4 d-none"></h5>

                    <div id="courseEditForm" class="container d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="courseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                                <input id="courseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                                <input id="courseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                                <input id="courseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="courseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                                <input id="courseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                                <input id="courseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>

                    <img id="courseEditLoader" class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
                    <h5 id="courseEditWrong" class="d-none">Something went wrong!!</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="courseUpdateConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do you want to Delete?</h5>
                    <h5 id="courseDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">no</button>
                    <button id="courseDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript">
        getCoursesData();


        // For Course Table
        function getCoursesData() {
            axios.get('/getCoursesData')

                .then(function(response) {

                    if (response.status === 200) {

                        $('#mainDivCourse').removeClass('d-none');
                        $('#loaderDivCourse').addClass('d-none');

                        $('#courseDataTable').DataTable().destroy();
                        $('#course_table').empty();

                        let jsonData = response.data;

                        $.each(jsonData, function (i, item) {
                            $('<tr>').html(
                                "<td>" +jsonData[i].course_name + "</td>" +
                                "<td>" + jsonData[i].course_fee + "</td>" +
                                "<td>" + jsonData[i].course_total_class + "</td>" +
                                "<td>" + jsonData[i].course_total_enroll + "</td>" +

                                "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a> </td>" +

                                "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#course_table');
                        });

                        $('.courseDeleteBtn').click(function () {
                            let id=$(this).data('id');
                            $('#courseDeleteId').html(id);
                            $('#deleteCourseModal').modal('show');
                        });


                        $('.courseEditBtn').click(function () {
                            let id=$(this).data('id');
                            courseUpdateDetails(id);
                            $('#courseEditId').html(id);
                            $('#updateCourseModal').modal('show');
                        });


                        // Data Table method
                        $('#courseDataTable').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');


                    } else {

                        $('#loaderDivCourse').addClass('d-none');
                        $('#wrongDivCourse').removeClass('d-none');
                    }

                })
                .catch(function(error) {

                    $('#loaderDivCourse').addClass('d-none');
                    $('#wrongDivCourse').removeClass('d-none');

                });
        }

        $('#addNewCourseBtnId').click(function () {
            $('#addCourseModal').modal('show');
        });


        // Course Add Confirm
        $('#courseAddConfirmBtn').click(function () {

            let courseName =$('#courseNameId').val();
            let courseDes =$('#courseDesId').val();
            let courseFee =$('#courseFeeId').val();
            let courseEnroll =$('#courseEnrollId').val();
            let courseClass =$('#courseClassId').val();
            let courseLink =$('#courseLinkId').val();
            let courseImg =$('#courseImgId').val();
            courseAdd(courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg);
        });


        // Course Add Method
        function courseAdd(courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg) {

            if (courseName.length===0){
                toastr.error('Course Name is Empty');
            }
            else if (courseDes.length===0){
                toastr.error('Course Description is Empty');
            }
            else if (courseFee.length===0){
                toastr.error('Course Fee is Empty');
            }
            else if (courseEnroll.length===0){
                toastr.error('Course Enroll is Empty');
            }
            else if (courseClass.length===0){
                toastr.error('Course Class is Empty');
            }
            else if (courseLink.length===0){
                toastr.error('Course Link is Empty');
            }
            else if (courseImg.length===0){
                toastr.error('Course Image is Empty');
            }
            else {
                $('#courseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/coursesAdd', {
                    course_name: courseName,
                    course_description: courseDes,
                    course_fee: courseFee,
                    course_total_enroll: courseEnroll,
                    course_total_class: courseClass,
                    course_link: courseLink,
                    course_image: courseImg,
                })
                    .then(function(response) {
                        $('#CourseAddConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#addCourseModal').modal('hide');
                                toastr.success('Add Success');
                                getCoursesData();
                            } else {
                                $('#addCourseModal').modal('hide');
                                toastr.error('Add Fail');
                                getCoursesData();
                            }
                        }
                        else {
                            $('#addCourseModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }


        // Course Delete Confirm
        $('#courseDeleteConfirmBtn').click(function () {
            let id = $('#courseDeleteId').html();
            courseDelete(id);
        })


        // Course Delete
        function courseDelete(deleteId) {
            $('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
            axios.post('/coursesDelete', {
                id: deleteId
            })
                .then(function(response) {
                    $('#courseDeleteConfirmBtn').html("yes");
                    if (response.status===200){
                        if (response.data === 1) {
                            $('#deleteCourseModal').modal('hide');
                            toastr.success('Delete Success');
                            getCoursesData();
                        } else {
                            $('#deleteCourseModal').modal('hide');
                            toastr.error('Delete Fail');
                            getCoursesData();
                        }
                    }
                    else {
                        $('#deleteCourseModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                })
        }


        // Each Course Update Details
        function courseUpdateDetails(detailsId) {
            axios.post('/coursesDetails', {
                id: detailsId
            })
                .then(function(response) {

                    if (response.status===200){
                        $('#courseEditForm').removeClass('d-none');
                        $('#courseEditLoader').addClass('d-none');

                        let jsonData = response.data;
                        $('#courseNameUpdateId').val(jsonData[0].course_name);
                        $('#courseDesUpdateId').val(jsonData[0].course_description);
                        $('#courseFeeUpdateId').val(jsonData[0].course_fee);
                        $('#courseEnrollUpdateId').val(jsonData[0].course_total_enroll);
                        $('#courseClassUpdateId').val(jsonData[0].course_total_class);
                        $('#courseLinkUpdateId').val(jsonData[0].course_link);
                        $('#courseImgUpdateId').val(jsonData[0].course_image);
                    }
                    else{
                        $('#courseEditWrong').removeClass('d-none');
                        $('#courseEditLoader').addClass('d-none');
                    }

                })
                .catch(function(error) {
                    $('#courseEditWrong').removeClass('d-none');
                    $('#courseEditLoader').addClass('d-none');
                })
        }


        $('#courseUpdateConfirmBtn').click(function () {

            let courseId = $('#courseEditId').html();
            let courseName = $('#courseNameUpdateId').val();
            let courseDesc = $('#courseDesUpdateId').val();
            let courseFee = $('#courseFeeUpdateId').val();
            let courseEnroll = $('#courseEnrollUpdateId').val();
            let courseClass = $('#courseClassUpdateId').val();
            let courseLink = $('#courseLinkUpdateId').val();
            let courseImg = $('#courseImgUpdateId').val();
            courseUpdate(courseId, courseName, courseDesc, courseFee, courseEnroll, courseClass, courseLink, courseImg);
        })


        // Course Update
        function courseUpdate(courseId, courseName, courseDesc, courseFee, courseEnroll, courseClass, courseLink, courseImg) {

            if (courseName.length===0){
                toastr.error('Service Name is Empty');
            }
            else if (courseDesc.length===0){
                toastr.error('Service Description is Empty');
            }
            else if (courseFee.length===0){
                toastr.error('Course Fee is Empty');
            }
            else if (courseEnroll.length===0){
                toastr.error('Course Enroll is Empty');
            }
            else if (courseClass.length===0){
                toastr.error('Course Class is Empty');
            }
            else if (courseLink.length===0){
                toastr.error('Course Link is Empty');
            }
            else if (courseImg.length===0){
                toastr.error('Course Image is Empty');
            }
            else {
                $('#courseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/coursesUpdate', {
                    id: courseId,
                    course_name: courseName,
                    course_description: courseDesc,
                    course_fee: courseFee,
                    course_total_enroll: courseEnroll,
                    course_total_class: courseClass,
                    course_link: courseLink,
                    course_image: courseImg,
                })
                    .then(function(response) {
                        $('#courseUpdateConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#updateCourseModal').modal('hide');
                                toastr.success('Update Success');
                                getCoursesData();
                            } else {
                                $('#updateCourseModal').modal('hide');
                                toastr.error('Update Fail');
                                getCoursesData();
                            }
                        }
                        else {
                            $('#updateCourseModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }



    </script>

@endsection
