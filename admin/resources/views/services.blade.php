@extends('layout.app')
@section('content')
    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Image</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="service_table">

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something went wrong!!</h3>
            </div>
        </div>
    </div>




    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do you want to Delete?</h5>
                    <h5 id="serviceDeleteId" class="mt-4"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">no</button>
                    <button id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">

                    <h5 id="serviceEditId" class="mt-4"></h5>

                    <div id="serviceEditForm" class="d-none w-100">

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Service Name:</label>
                            <input type="text" id="serviceNameId" class="form-control" placeholder="Service Name"/>
                        </div>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Service Description:</label>
                            <input type="text" id="serviceDescId" class="form-control" placeholder="Service Description"/>
                        </div>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Service Image Link:</label>
                            <input type="text" id="serviceImgId" class="form-control" placeholder="Service Image Link"/>
                        </div>

                    </div>

                    <img id="serviceEditLoader" class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
                    <h5 id="serviceEditWrong" class="d-none">Something went wrong!!</h5>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">

                    <div id="serviceAddForm" class="w-100">

                        <h6 class="mb-4 fa bold">Add New Service</h6>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Service Name:</label>
                            <input type="text" id="serviceNameAddId" class="form-control" placeholder="Service Name"/>
                        </div>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Service Description:</label>
                            <input type="text" id="serviceDescAddId" class="form-control" placeholder="Service Description"/>
                        </div>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Service Image Link:</label>
                            <input type="text" id="serviceImgAddId" class="form-control" placeholder="Service Image Link"/>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger">save</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')

    <script type="text/javascript">
        getServicesData();


        // For Services Table
        function getServicesData() {
            axios.get('/getServicesData')

                .then(function(response) {

                    if (response.status === 200) {

                        $('#mainDiv').removeClass('d-none');
                        $('#loaderDiv').addClass('d-none');

                        $('#service_table').empty();

                        let jsonData = response.data;

                        $.each(jsonData, function(i, item) {
                            $('<tr>').html(
                                "<td><img class='table-img' src=" + jsonData[i].service_image + "></td>" +
                                "<td>" + jsonData[i].service_name + "</td>" +
                                "<td>" + jsonData[i].service_description + "</td>" +
                                "<td><a class='serviceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a> </td>" +
                                "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#service_table');
                        });

                        // Services Table Delete icon click
                        $('.serviceDeleteBtn').click(function() {
                            let id = $(this).data('id');

                            $('#serviceDeleteId').html(id);
                            $('#deleteModal').modal('show');
                        })


                        // Services Table Edit icon click
                        $('.serviceEditBtn').click(function() {
                            let id = $(this).data('id');
                            $('#serviceEditId').html(id);
                            serviceUpdateDetails(id);
                            $('#editModal').modal('show');
                        })


                    } else {

                        $('#wrongDiv').removeClass('d-none');
                        $('#loaderDiv').addClass('d-none');

                    }


                })
                .catch(function(error) {

                    $('#wrongDiv').removeClass('d-none');
                    $('#loaderDiv').addClass('d-none');

                });
        }



        // Services Delete Modal Yes Btn
        $('#serviceDeleteConfirmBtn').click(function() {
            let id = $('#serviceDeleteId').html();
            serviceDelete(id);
        })

        // Services Delete
        function serviceDelete(deleteId) {
            $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
            axios.post('/serviceDelete', {
                id: deleteId
            })
                .then(function(response) {
                    $('#serviceDeleteConfirmBtn').html("yes");
                    if (response.status===200){
                        if (response.data === 1) {
                            $('#deleteModal').modal('hide');
                            toastr.success('Delete Success');
                            getServicesData();
                        } else {
                            $('#deleteModal').modal('hide');
                            toastr.error('Delete Fail');
                            getServicesData();
                        }
                    }
                    else {
                        $('#deleteModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                })
        }

        // Each Service Update Details
        function serviceUpdateDetails(detailsId) {
            axios.post('/serviceDetails', {
                id: detailsId
            })
                .then(function(response) {

                    if (response.status===200){
                        $('#serviceEditForm').removeClass('d-none');
                        $('#serviceEditLoader').addClass('d-none');

                        let jsonData = response.data;
                        $('#serviceNameId').val(jsonData[0].service_name);
                        $('#serviceDescId').val(jsonData[0].service_description);
                        $('#serviceImgId').val(jsonData[0].service_image);
                    }
                    else{
                        $('#serviceEditWrong').removeClass('d-none');
                        $('#serviceEditLoader').addClass('d-none');
                    }

                })
                .catch(function(error) {
                    $('#serviceEditWrong').removeClass('d-none');
                    $('#serviceEditLoader').addClass('d-none');
                })
        }



        // Services Edit Modal Save Btn
        $('#serviceEditConfirmBtn').click(function() {
            let id = $('#serviceEditId').html();
            let name = $('#serviceNameId').val();
            let desc = $('#serviceDescId').val();
            let img = $('#serviceImgId').val();
            serviceUpdate(id,name,desc,img);
        })

        // Service Update
        function serviceUpdate(serviceId, serviceName, serviceDesc, serviceImg) {

            if (serviceName.length===0){
                toastr.error('Service Name is Empty');
            }
            else if (serviceDesc.length===0){
                toastr.error('Service Description is Empty');
            }
            else if (serviceImg.length===0){
                toastr.error('Service Image is Empty');
            }
            else {
                $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/serviceUpdate', {
                    id: serviceId,
                    name: serviceName,
                    desc: serviceDesc,
                    img: serviceImg,
                })
                    .then(function(response) {
                        $('#serviceEditConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#editModal').modal('hide');
                                toastr.success('Update Success');
                                getServicesData();
                            } else {
                                $('#editModal').modal('hide');
                                toastr.error('Update Fail');
                                getServicesData();
                            }
                        }
                        else {
                            $('#editModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#editModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }

        // Service Add new Btn Click
        $('#addNewBtnId').click(function () {

            $('#addModal').modal('show');
        })


        // Services Add Modal Save Btn
        $('#serviceAddConfirmBtn').click(function() {
            let name = $('#serviceNameAddId').val();
            let desc = $('#serviceDescAddId').val();
            let img = $('#serviceImgAddId').val();
            serviceAdd(name,desc,img);
        })


        // Service Add Method
        function serviceAdd(serviceName, serviceDesc, serviceImg) {

            if (serviceName.length===0){
                toastr.error('Service Name is Empty');
            }
            else if (serviceDesc.length===0){
                toastr.error('Service Description is Empty');
            }
            else if (serviceImg.length===0){
                toastr.error('Service Image is Empty');
            }
            else {
                $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/serviceAdd', {
                    name: serviceName,
                    desc: serviceDesc,
                    img: serviceImg,
                })
                    .then(function(response) {
                        $('#serviceAddConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#addModal').modal('hide');
                                toastr.success('Add Success');
                                getServicesData();
                            } else {
                                $('#addModal').modal('hide');
                                toastr.error('Add Fail');
                                getServicesData();
                            }
                        }
                        else {
                            $('#addModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }


    </script>

@endsection
