@extends('layout.app')
@section('content')

    <div id="mainDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <button id="addNewCourseBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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

                    <h5 id="courseEditId" class="mt-4"></h5>

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
                    <h5 id="courseDeleteId" class="mt-4"></h5>
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

    </script>

@endsection
