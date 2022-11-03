$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


 function getServicesData() {
    axios.get('/getServicesData')

    .then(function (response) {

        if (response.status===200){

            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            let jsonData=response.data;

            $.each(jsonData,function (i,item) {
                $('<tr>').html(
                    "<td><img class='table-img' src="+jsonData[i].service_image +"></td>" +
                    "<td>"+ jsonData[i].service_name +"</td>" +
                    "<td>"+ jsonData[i].service_description +"</td>" +
                    "<td><a href='' ><i class='fas fa-edit'></i></a> </td>" +
                    "<td><a data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#service_table');
            });
        }

        else {

            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

        }


    })
        .catch(function (error) {

            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

        });
}
