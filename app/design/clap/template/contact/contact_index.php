<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/3/2015
 * Time: 8:52 AM
 */
?>

<section id="contact-info">
    <div class="center">
        <h2>How to Reach Us?</h2>
        <p class="lead">CLAP is always ready to hear from you</p>
    </div>
    <div class="gmap-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <div class="gmap">
                        <div id="map_canvas">

                        </div>
                    </div>
                </div>

                <script src="https://maps.googleapis.com/maps/api/js"></script>
                <script>
                    function initialize() {
                        var map_canvas = document.getElementById('map_canvas');
                        var map_options = {
                            center: new google.maps.LatLng(9.119491, 7.407467),
                            zoom: 12,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                        var map = new google.maps.Map(map_canvas, map_options)
                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>

                <div class="col-sm-7 map-content">
                    <ul class="row">
                        <li class="col-sm-6">
                            <address>
                                <h5>Head Office</h5>
                                <p>No. 6 Gindiri Street,<br/>
                                    Off Ubiaja Crescent by Tantalizers,<br/>
                                    Garki II P. O. Box 1101, Garki Abuja
                                </p>
                                <p>Phone:: 09-6717056; 0803-313-9486; 0805-618-0190 <br>
                                    Email Address:info@clapnigeria.org</p>
                            </address>

                            <address>
                                <h5>Lagos State</h5>
                                <p>34, Samuel Street,<br/> Egbada, Lagos</p>
                                <p>Phone:670-898-2847 <br>
                                    Email Address:lagosoffice@clapnigeria.org</p>
                            </address>
                        </li>


                        <li class="col-sm-6">
                            <address>
                                <h5>Anambara State</h5>
                                <p>Opposite St. Theresa's Catholic Church,<br/>
                                    Uli Centre, Uli,<br/>
                                    Anambara  state.
                                </p>
                                <p>Phone:670-898-2847 <br>
                                    Email Address:anambaraoffice@clapnigeria.org</p>
                            </address>

                            <address>
                                <h5>Nasarawa Office</h5>
                                <p>Opposite ERCC Zion Gate,<br/>
                                    Wanba  By-Pass,<br/>
                                    Akwanga, Nasarawa state.
                                </p>
                                <p>Phone:670-898-2847 <br>
                                    Email Address:nasarawa@clapnigeria.org</p>
                            </address>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>  <!--/gmap_area -->

<section id="contact-page">
    <div class="container">
        <div class="center">
            <h2>Drop Your Message</h2>
            <p class="lead">Do you have an enquiry, suggestion, problem, ... Just share</p>
        </div>
        <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="main-contact-form-j" class="contact-form" name="contact-form" method="post" action="<?php echo OpenSms::getActionUrl('send') ?>">
                <div class="col-sm-5 col-sm-offset-1">
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Subject *</label>
                        <input type="text" name="subject" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                    </div>
                </div>
            </form>
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#contact-page-->