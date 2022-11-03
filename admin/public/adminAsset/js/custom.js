
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
                        "<td><a href='' ><i class='fas fa-edit'></i></a> </td>" +
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
                    getServicesDelete(id);
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
function getServicesDelete(deleteId) {
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
