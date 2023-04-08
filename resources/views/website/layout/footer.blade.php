

<footer class=" footer text-center text-lg-start py-4 bg-custom ">
    <!-- Section: Social media -->

    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 " data-i18n="creator">
                {{__('creator')}}
            </div>
            <div class="col-md-4 " data-i18n="Copyright">
                {{__('Copyright')}}
            </div>

            <div class="col-md-4 socail mt-md-0 mt-4">
                <div>
                    <!-- Facebook -->
                    <a class="btn btn-outline-light btn-floating m-1" href="{{$settings->facebook_link}}" role="button"><i
                            class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn btn-outline-light btn-floating m-1" href="{{$settings->twitter_link}}" role="button"><i class="fab fa-twitter"></i></a>

                    <!-- Instagram -->
                    <a class="btn btn-outline-light instagram btn-floating m-1" href="{{$settings->instagram_link}}" role="button"><i
                            class="fab fa-instagram"></i></a>

                </div>
            </div>
        </div>
    </div>

</footer>
