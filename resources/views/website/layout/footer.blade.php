
<!-- Footer -->
<footer class="footer text-center text-lg-start py-4 bg-custom">
    <!-- Section: Social media -->

    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 " data-i18n="creator">
                {{__('creator')}}
            </div>
            <div class="col-md-4" data-i18n="Copyright">
                {{__('Copyright')}}
            </div>
            <div class="col-md-4 socail">
                <div>
                    <a href="{{$settings->facebook_link}}" class="me-4 text-reset" >
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{$settings->twitter_link}}" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{$settings->instagram_link}}" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
