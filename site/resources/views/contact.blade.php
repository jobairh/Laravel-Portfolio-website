@extends('layout.app')

@section('content')

    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="{{ asset('frontEndAsset') }}/images/knowledge.svg">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="service-card-title">ম্যাপ </h3>
                <hr>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.6928005974664!2d90.41750761445732!3d23.829520591667254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7384ca2c6b3%3A0x6c9e18e5c1293c2c!2sNikunja-2%20BUS%20Stop!5e0!3m2!1sen!2sbd!4v1668613989319!5m2!1sen!2sbd" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-md-6">

                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> নিকুঞ্জ-২, খিলক্ষেত, ঢাকা
                    <i class="fas fa-envelope ml-2"></i> jobairh999@gmail.com
                    <i class="fas fa-phone ml-2"></i> ০১৮৮২১০৯৪৫৭
                </p>

                <hr>

                <br>
                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>
        </div>
    </div>

@endsection
