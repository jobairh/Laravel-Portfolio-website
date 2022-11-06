
// Visitor Page Table
$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

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

                // Services Delete Modal Yes Btn
                $('#serviceDeleteConfirmBtn').click(function() {
                    let id = $('#serviceDeleteId').html();
                    serviceDelete(id);
                })

                // Services Table Edit icon click
                $('.serviceEditBtn').click(function() {
                    let id = $(this).data('id');
                    $('#serviceEditId').html(id);
                    serviceUpdateDetails(id);
                    $('#editModal').modal('show');
                })

                // Services Edit Modal Save Btn
                $('#serviceEditConfirmBtn').click(function() {
                    let id = $('#serviceEditId').html();
                    let name = $('#serviceNameId').val();
                    let desc = $('#serviceDescId').val();
                    let img = $('#serviceImgId').val();
                    serviceUpdate(id,name,desc,img);
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

// Services Delete
function serviceDelete(deleteId) {
    axios.post('/serviceDelete', {
        id: deleteId
    })
        .then(function(response) {
            if (response.data === 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Success  ');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete Fail');
                getServicesData();
            }
        })
        .catch(function(error) {

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
        axios.post('/serviceUpdate', {
            id: serviceId,
            name: serviceName,
            desc: serviceDesc,
            img: serviceImg,
        })
            .then(function(response) {
                if (response.data === 1) {
                    $('#editModal').modal('hide');
                    toastr.success('Update Success');
                    getServicesData();
                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Update Fail');
                    getServicesData();
                }

            })
            .catch(function(error) {

            })
    }

}
