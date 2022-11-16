@extends('layout.app')
@section('content')

    <div id="mainDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <button id="addNewReviewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

                <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Review Name</th>
                        <th class="th-sm">Review Description</th>
                        <th class="th-sm">Review Image</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="review_table">


                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div id="loaderDivReview" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something went wrong!!</h3>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="reviewNameId" type="text" class="form-control mb-3" placeholder="Review Name">
                                <input id="reviewDesId" type="text" class="form-control mb-3" placeholder="Review Description">
                                <input id="reviewImgId" type="text" class="form-control mb-3" placeholder="Review Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="reviewAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do you want to Delete?</h5>
                    <h5 id="reviewDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">no</button>
                    <button id="reviewDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="updateReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">

                    <h5 id="reviewEditId" class="mt-4 d-none"></h5>

                    <div id="reviewEditForm" class="container d-none">
                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Review Name:</label>
                            <input type="text" id="reviewNameUpdateId" class="form-control" placeholder="Review Name"/>
                        </div>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Review Description:</label>
                            <input type="text" id="reviewDescUpdateId" class="form-control" placeholder="Review Description"/>
                        </div>

                        <div class="form-outline mb-4 text-left">
                            <label class="form-label" for="form5Example1">Review Image Link:</label>
                            <input type="text" id="reviewImgUpdateId" class="form-control" placeholder="Review Image Link"/>
                        </div>
                    </div>

                    <img id="reviewEditLoader" class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
                    <h5 id="reviewEditWrong" class="d-none">Something went wrong!!</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="reviewUpdateConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getReviewsData();


        // For Review Table
        function getReviewsData() {
            axios.get('/reviewsData')

                .then(function(response) {

                    if (response.status === 200) {

                        $('#mainDivReview').removeClass('d-none');
                        $('#loaderDivReview').addClass('d-none');

                        $('#reviewDataTable').DataTable().destroy();
                        $('#review_table').empty();

                        let jsonData = response.data;

                        $.each(jsonData, function (i, item) {
                            $('<tr>').html(
                                "<td>" +jsonData[i].name+ "</td>" +
                                "<td>" + jsonData[i].description+ "</td>" +
                                "<td>" + jsonData[i].image+ "</td>" +

                                "<td><a class='reviewEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a> </td>" +

                                "<td><a class='reviewDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#review_table');
                        });

                        $('.reviewDeleteBtn').click(function () {
                            let id=$(this).data('id');
                            $('#reviewDeleteId').html(id);
                            $('#deleteReviewModal').modal('show');
                        });


                        $('.reviewEditBtn').click(function () {
                            let id=$(this).data('id');
                            reviewUpdateDetails(id);
                            $('#reviewEditId').html(id);
                            $('#updateReviewModal').modal('show');
                        });


                        // Data Table method
                        $('#reviewDataTable').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');


                    } else {

                        $('#loaderDivReview').addClass('d-none');
                        $('#wrongDivReview').removeClass('d-none');
                    }

                })
                .catch(function(error) {

                    $('#loaderDivReview').addClass('d-none');
                    $('#wrongDivReview').removeClass('d-none');

                });
        }


        $('#addNewReviewBtnId').click(function () {
            $('#addReviewModal').modal('show');
        });

        $('#reviewAddConfirmBtn').click(function () {

            let reviewName = $('#reviewNameId').val();
            let reviewDes = $('#reviewDesId').val();
            let reviewImg = $('#reviewImgId').val();
            reviewAdd(reviewName, reviewDes, reviewImg);
        });



        // Review Add Method
        function reviewAdd(reviewName, reviewDes, reviewImg) {

            if (reviewName.length===0){
                toastr.error('Review Name is Empty');
            }
            else if (reviewDes.length===0){
                toastr.error('Review Description is Empty');
            }
            else if (reviewImg.length===0){
                toastr.error('Review Image is Empty');
            }

            else {
                $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/reviewsAdd', {
                    name: reviewName,
                    description: reviewDes,
                    image: reviewImg
                })
                    .then(function(response) {
                        $('#reviewAddConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#addReviewModal').modal('hide');
                                toastr.success('Add Success');
                                getReviewsData();
                            } else {
                                $('#addReviewModal').modal('hide');
                                toastr.error('Add Fail');
                                getReviewsData();
                            }
                        }
                        else {
                            $('#addReviewModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#addReviewModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }

        // Delete confirm Btn
        $('#reviewDeleteConfirmBtn').click(function () {

            let id = $('#reviewDeleteId').html();
            reviewDelete(id);
        });


        // Review Delete
        function reviewDelete(deleteId) {
            $('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
            axios.post('/reviewsDelete', {
                id: deleteId
            })
                .then(function(response) {
                    $('#reviewDeleteConfirmBtn').html("yes");
                    if (response.status===200){
                        if (response.data === 1) {
                            $('#deleteReviewModal').modal('hide');
                            toastr.success('Delete Success');
                            getReviewsData();
                        } else {
                            $('#deleteReviewModal').modal('hide');
                            toastr.error('Delete Fail');
                            getReviewsData();
                        }
                    }
                    else {
                        $('#deleteReviewModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteReviewModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                })
        }


        // Each Review Update Details
        function reviewUpdateDetails(detailsId) {
            axios.post('/reviewsDetails', {
                id: detailsId
            })
                .then(function(response) {

                    if (response.status===200){
                        $('#reviewEditForm').removeClass('d-none');
                        $('#reviewEditLoader').addClass('d-none');

                        let jsonData = response.data;
                        $('#reviewNameUpdateId').val(jsonData[0].name);
                        $('#reviewDescUpdateId').val(jsonData[0].description);
                        $('#reviewImgUpdateId').val(jsonData[0]. image);
                    }
                    else{
                        $('#reviewEditWrong').removeClass('d-none');
                        $('#reviewEditLoader').addClass('d-none');
                    }

                })
                .catch(function(error) {
                    $('#reviewEditWrong').removeClass('d-none');
                    $('#reviewEditLoader').addClass('d-none');
                })
        }


        $('#reviewUpdateConfirmBtn').click(function () {

            let reviewId = $('#reviewEditId').html();
            let reviewName = $('#reviewNameUpdateId').val();
            let reviewDesc = $('#reviewDescUpdateId').val();
            let reviewImg = $('#reviewImgUpdateId').val();
            reviewUpdate(reviewId, reviewName, reviewDesc, reviewImg);
        });


        // Review Update
        function reviewUpdate(reviewId, reviewName, reviewDesc, reviewImg) {

            if (reviewName.length===0){
                toastr.error('Review Name is Empty');
            }
            else if (reviewDesc.length===0){
                toastr.error('Review Description is Empty');
            }
            else if (reviewImg.length===0){
                toastr.error('Review Image is Empty');
            }
            else {
                $('#reviewUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
                axios.post('/reviewsUpdate', {
                    id: reviewId,
                    name: reviewName,
                    description : reviewDesc,
                    image: reviewImg
                })
                    .then(function(response) {
                        $('#reviewUpdateConfirmBtn').html("save");
                        if (response.status===200){
                            if (response.data === 1) {
                                $('#updateReviewModal').modal('hide');
                                toastr.success('Update Success');
                                getReviewsData();
                            } else {
                                $('#updateReviewModal').modal('hide');
                                toastr.error('Update Fail');
                                getReviewsData();
                            }
                        }
                        else {
                            $('#updateReviewModal').modal('hide');
                            toastr.error('Something Went Wrong!');
                        }

                    })
                    .catch(function(error) {
                        $('#updateReviewModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    })
            }

        }


    </script>
@endsection
