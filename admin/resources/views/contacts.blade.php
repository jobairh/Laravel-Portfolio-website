@extends('layout.app')

@section('title','Contact')

@section('content')
    <div id="mainDivContact" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Contact Name</th>
                        <th class="th-sm">Contact Mobile</th>
                        <th class="th-sm">Contact Email</th>
                        <th class="th-sm">Contact Message</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="contact_table">


                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="loaderDivContact" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading_icon m-5" src="{{ asset('adminAsset') }}/images/loader.svg" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDivContact" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something went wrong!!</h3>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do you want to Delete?</h5>
                    <h5 id="contactDeleteId" class="mt-4 d-none"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">no</button>
                    <button id="contactDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        getContactsData();


        // For Contact Table
        function getContactsData() {
            axios.get('/contactsData')

                .then(function(response) {

                    if (response.status === 200) {

                        $('#mainDivContact').removeClass('d-none');
                        $('#loaderDivContact').addClass('d-none');

                        $('#contactDataTable').DataTable().destroy();
                        $('#contact_table').empty();

                        let jsonData = response.data;

                        $.each(jsonData, function (i, item) {
                            $('<tr>').html(
                                "<td>" +jsonData[i].contact_name + "</td>" +
                                "<td>" + jsonData[i].contact_mobile + "</td>" +
                                "<td>" + jsonData[i].contact_email + "</td>" +
                                "<td>" + jsonData[i].contact_msg + "</td>" +

                                "<td><a class='contactDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                            ).appendTo('#contact_table');
                        });

                        $('.contactDeleteBtn').click(function () {
                            let id=$(this).data('id');
                            $('#contactDeleteId').html(id);
                            $('#deleteContactModal').modal('show');
                        });


                        // Data Table method
                        $('#contactDataTable').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');


                    } else {

                        $('#loaderDivContact').addClass('d-none');
                        $('#wrongDivContact').removeClass('d-none');
                    }

                })
                .catch(function(error) {

                    $('#loaderDivContact').addClass('d-none');
                    $('#wrongDivContact').removeClass('d-none');

                });
        }


        // Delete confirm Btn
        $('#contactDeleteConfirmBtn').click(function () {

            let id = $('#contactDeleteId').html();
            contactDelete(id);
        });


        // Contact Delete
        function contactDelete(deleteId) {
            $('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//animation.......
            axios.post('/contactsDelete', {
                id: deleteId
            })
                .then(function(response) {
                    $('#contactDeleteConfirmBtn').html("yes");
                    if (response.status===200){
                        if (response.data === 1) {
                            $('#deleteContactModal').modal('hide');
                            toastr.success('Delete Success');
                            getContactsData();
                        } else {
                            $('#deleteContactModal').modal('hide');
                            toastr.error('Delete Fail');
                            getContactsData();
                        }
                    }
                    else {
                        $('#deleteContactModal').modal('hide');
                        toastr.error('Something Went Wrong!');
                    }

                })
                .catch(function(error) {
                    $('#deleteContactModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                })
        }
    </script>
@endsection
