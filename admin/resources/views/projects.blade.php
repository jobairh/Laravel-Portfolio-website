@extends('layout.app')

@section('title','Project')

@section('content')

    <div id="mainDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <button id="addNewProjectBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

                <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Project Name</th>
                        <th class="th-sm">Project Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="project_table">


                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div id="loaderDivProject" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something went wrong!!</h3>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="projectNameId" type="text" class="form-control mb-3" placeholder="Project Name">
                                <input id="projectDesId" type="text" class="form-control mb-3" placeholder="Project Description">
                                <input id="projectLinkId" type="text" class="form-control mb-3" placeholder="Project Link">
                                <input id="projectImgId" type="text" class="form-control mb-3" placeholder="Project Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="projectAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do you want to Delete?</h5>
                    <h5 id="projectDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">no</button>
                    <button id="projectDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">

                    <h5 id="projectEditId" class="mt-4 d-none"></h5>

                    <div id="projectEditForm" class="container d-none">
                            <div class="form-outline mb-4 text-left">
                                <label class="form-label" for="form5Example1">Project Name:</label>
                                <input type="text" id="projectNameUpdateId" class="form-control" placeholder="Project Name"/>
                            </div>

                            <div class="form-outline mb-4 text-left">
                                <label class="form-label" for="form5Example1">Project Description:</label>
                                <input type="text" id="projectDescUpdateId" class="form-control" placeholder="Project Description"/>
                            </div>

                            <div class="form-outline mb-4 text-left">
                                <label class="form-label" for="form5Example1">Project Link:</label>
                                <input type="text" id="projectLinkUpdateId" class="form-control" placeholder="Project Link"/>
                            </div>

                            <div class="form-outline mb-4 text-left">
                                <label class="form-label" for="form5Example1">Project Image Link:</label>
                                <input type="text" id="projectImgUpdateId" class="form-control" placeholder="Project Image Link"/>
                            </div>
                    </div>

                    <img id="projectEditLoader" class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
                    <h5 id="projectEditWrong" class="d-none">Something went wrong!!</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="projectUpdateConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getProjectsData();


        // For Project Table
        function getProjectsData() {
            axios.get('/getProjectsData')

                .then(function(response) {

                    if (response.status === 200) {

                        $('#mainDivProject').removeClass('d-none');
                        $('#loaderDivProject').addClass('d-none');

                        $('#projectDataTable').DataTable().destroy();
                        $('#project_table').empty();

                        let jsonData = response.data;

                        $.each(jsonData, function (i, item) {
                            $('<tr>').html(
                                "<td>" +jsonData[i].project_name + "</td>" +
                                "<td>" + jsonData[i].project_description + "</td>" +

                                "<td><a class='projectEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a> </td>" +

                                "<td><a class='projectDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#project_table');
                        });

                        $('.projectDeleteBtn').click(function () {
                            let id=$(this).data('id');
                            $('#projectDeleteId').html(id);
                            $('#deleteProjectModal').modal('show');
                        });


                        $('.projectEditBtn').click(function () {
                            let id=$(this).data('id');
                            projectUpdateDetails(id);
                            $('#projectEditId').html(id);
                            $('#updateProjectModal').modal('show');
                        });


                        // Data Table method
                        $('#projectDataTable').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');


                    } else {

                        $('#loaderDivProject').addClass('d-none');
                        $('#wrongDivProject').removeClass('d-none');
                    }

                })
                .catch(function(error) {

                    $('#loaderDivProject').addClass('d-none');
                    $('#wrongDivProject').removeClass('d-none');

                });
        }


        $('#addNewProjectBtnId').click(function () {
            $('#addProjectModal').modal('show');
        });

        $('#projectAddConfirmBtn').click(function () {

            let projectName = $('#projectNameId').val();
            let projectDes = $('#projectDesId').val();
            let projectLink = $('#projectLinkId').val();
            let projectImg = $('#projectImgId').val();
            projectAdd(projectName, projectDes, projectLink, projectImg);
        });



        // Project Add Method
        function projectAdd(projectName, projectDes, projectLink, projectImg) {

            if (projectName.length===0){
                toastr.error('Project Name is Empty');
            }
            else if (projectDes.length===0){
                toastr.error('Project Description is Empty');
            }
            else if (projectLink.length===0){
                toastr.error('Project Fee is Empty');
            }
            else if (projectImg.length===0){
                toastr.error('Project Image is Empty');
            }

            else {
                $('#projectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/projectsAdd', {
                    project_name: projectName,
                    project_description: projectDes,
                    project_link: projectLink,
                    project_image: projectImg,
                })
                    .then(function(response) {
                        $('#projectAddConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#addProjectModal').modal('hide');
                                toastr.success('Add Success');
                                getProjectsData();
                            } else {
                                $('#addProjectModal').modal('hide');
                                toastr.error('Add Fail');
                                getProjectsData();
                            }
                        }
                        else {
                            $('#addProjectModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addProjectModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }

        // Delete confirm Btn
        $('#projectDeleteConfirmBtn').click(function () {

            let id = $('#projectDeleteId').html();
            projectDelete(id);
        });


        // Project Delete
        function projectDelete(deleteId) {
            $('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
            axios.post('/projectsDelete', {
                id: deleteId
            })
                .then(function(response) {
                    $('#projectDeleteConfirmBtn').html("yes");
                    if (response.status===200){
                        if (response.data === 1) {
                            $('#deleteProjectModal').modal('hide');
                            toastr.success('Delete Success');
                            getProjectsData();
                        } else {
                            $('#deleteProjectModal').modal('hide');
                            toastr.error('Delete Fail');
                            getProjectsData();
                        }
                    }
                    else {
                        $('#deleteProjectModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                })
        }


        // Each Project Update Details
        function projectUpdateDetails(detailsId) {
            axios.post('/projectsDetails', {
                id: detailsId
            })
                .then(function(response) {

                    if (response.status===200){
                        $('#projectEditForm').removeClass('d-none');
                        $('#projectEditLoader').addClass('d-none');

                        let jsonData = response.data;
                        $('#projectNameUpdateId').val(jsonData[0].project_name);
                        $('#projectDescUpdateId').val(jsonData[0].project_description);
                        $('#projectLinkUpdateId').val(jsonData[0].project_link);
                        $('#projectImgUpdateId').val(jsonData[0].project_image);
                    }
                    else{
                        $('#projectEditWrong').removeClass('d-none');
                        $('#projectEditLoader').addClass('d-none');
                    }

                })
                .catch(function(error) {
                    $('#projectEditWrong').removeClass('d-none');
                    $('#projectEditLoader').addClass('d-none');
                })
        }


        $('#projectUpdateConfirmBtn').click(function () {

            let projectId = $('#projectEditId').html();
            let projectName = $('#projectNameUpdateId').val();
            let projectDesc = $('#projectDescUpdateId').val();
            let projectLink = $('#projectLinkUpdateId').val();
            let projectImg = $('#projectImgUpdateId').val();
            projectUpdate(projectId, projectName, projectDesc, projectLink, projectImg);
        });


        // Project Update
        function projectUpdate(projectId, projectName, projectDesc, projectLink, projectImg) {

            if (projectName.length===0){
                toastr.error('Project Name is Empty');
            }
            else if (projectDesc.length===0){
                toastr.error('Project Description is Empty');
            }
            else if (projectLink.length===0){
                toastr.error('Project Link is Empty');
            }
            else if (projectImg.length===0){
                toastr.error('Project Image is Empty');
            }
            else {
                $('#projectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/projectsUpdate', {
                    id: projectId,
                    project_name: projectName,
                    project_description : projectDesc,
                    project_link: projectLink,
                    project_image: projectImg,
                })
                    .then(function(response) {
                        $('#projectUpdateConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#updateProjectModal').modal('hide');
                                toastr.success('Update Success');
                                getProjectsData();
                            } else {
                                $('#updateProjectModal').modal('hide');
                                toastr.error('Update Fail');
                                getProjectsData();
                            }
                        }
                        else {
                            $('#updateProjectModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#updateProjectModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }



    </script>
@endsection
