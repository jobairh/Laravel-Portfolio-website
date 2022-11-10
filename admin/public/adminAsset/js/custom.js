// For Services Table
function getCoursesData() {
    axios.get('/getCoursesData')

        .then(function(response) {

            if (response.status === 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                $('#course_table').empty();

                let jsonData = response.data;

                $.each(jsonData, function (i, item) {
                    $('<tr>').html(
                        "<td>" +jsonData[i].course_name + "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_total_class + "</td>" +
                        "<td>" + jsonData[i].course_total_enroll + "</td>" +

                        "<td><a class='courseViewDetailsBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-eye'></i></a> </td>" +

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

