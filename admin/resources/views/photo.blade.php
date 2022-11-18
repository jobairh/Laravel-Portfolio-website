@extends('layout.app')

@section('title','Photo Gallery')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 p-5">
                <button data-toggle="modal" data-target="#photoModal" id="addNewPhotoBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row photoRow">

        </div>
    </div>


    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="imgInput" type="file">
                    <img class="imgPreview mt-3" id="imgPreview" src="{{ asset('adminAsset') }}/images/default-image.jpg" alt="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button  id="savePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">

        $('#imgInput').change(function () {

            let reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (event) {
                let imgSource = event.target.result;
                $('#imgPreview').attr('src', imgSource);
            }
        })

        $('#savePhoto').on('click', function () {

            $('#savePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

            let photoFile = $('#imgInput').prop('files')[0];
            let formData = new FormData();
            formData.append('photo', photoFile)

            axios.post('/photoUpload', formData)
                .then(function (response) {
                    $('#savePhoto').html('save');

                    if (response.status===200 && response.data===1){

                        $('#photoModal').modal('hide');
                        toastr.success('Photo Upload Success');
                    }
                    else{
                        $('#photoModal').modal('hide');
                        toastr.error('Photo Upload Fail');
                    }
                })

                .catch(function (error) {
                    $('#photoModal').modal('hide');
                    toastr.error('Photo Upload Fail');
            })
        })

        loadPhoto();

        function loadPhoto() {

            axios.get('/photoJson')
                .then(function (response) {

                    $.each(response.data, function (i, item) {
                        $("<div class='col-md-3 p-1'>").html(
                            "<img class='imgOnRow' src="+item['location']+">"

                        ).appendTo('.photoRow');
                    });
            })
                .catch(function (error) {

            })
        }

    </script>
@endsection
