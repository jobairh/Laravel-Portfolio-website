<div class="container mt-5">
    <div class="row">

        @foreach($coursesData as $coursesData)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{ $coursesData->course_image }}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">আইটি কোর্স {{ $coursesData->course_name }}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{ $coursesData->course_description }}</h6>
                    <h6 class="service-card-subTitle p-0 ">{{ $coursesData->course_fee }} || {{ $coursesData->course_total_class }}</h6>
                    <a href="{{ $coursesData->course_link }}" target="_blank" class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
