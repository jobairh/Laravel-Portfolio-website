<div class="container section-marginTop text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">

        @foreach($coursesData as $coursesData)
        <div class="col-md-4 thumbnail-container">
            <img src="{{ $coursesData->course_image }}" alt="Avatar" class="thumbnail-image ">
            <div class="thumbnail-middle">
                <h1 class="thumbnail-title">{{ $coursesData->course_name }}</h1>
                <h1 class="thumbnail-subtitle">{{ $coursesData->course_description }}</h1>
                <h1 class="thumbnail-subtitle">{{ $coursesData->course_total_class }}</h1>
                <a target="_blank" href="{{ $coursesData->course_link }}" class="normal-btn btn">শুরু করুন</a>
            </div>
        </div>
        @endforeach


    </div>
</div>
