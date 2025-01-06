<x-frontend-app-layout :title="'Contact Us'">
    <div class="ps-contact">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">
                    Contact us
                </li>
            </ul>
            <div class="ps-contact__content">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="ps-contact__info">
                            <h2 class="ps-contact__title">How can we help you?</h2>
                            <p class="ps-contact__text">
                                We are at your disposal 7 days a week!
                            </p>
                            <h3 class="ps-contact__fax">{{ optional($setting)->contact_email }}</h3>
                            @php
                                // Fetch the work hours data
                                $workHours = DB::table('settings')->first();

                                // Initialize arrays to group days by their time ranges
                                $hoursRanges = [];

                                $days = [
                                    'monday' => 'Monday',
                                    'tuesday' => 'Tuesday',
                                    'wednesday' => 'Wednesday',
                                    'thursday' => 'Thursday',
                                    'friday' => 'Friday',
                                    'saturday' => 'Saturday',
                                    'sunday' => 'Sunday',
                                ];

                                // Populate the array with day names and time ranges
                                foreach ($days as $key => $day) {
                                    $startTime = $workHours->{'start_time_' . $key};
                                    $endTime = $workHours->{'end_time_' . $key};
                                    $description = $workHours->{$key};

                                    if ($startTime && $endTime) {
                                        $range = "$startTime – $endTime";
                                        if (!isset($hoursRanges[$range])) {
                                            $hoursRanges[$range] = [];
                                        }
                                        $hoursRanges[$range][] = $day;
                                    } elseif ($description) {
                                        $hoursRanges[$description] = [$day];
                                    }
                                }

                                // Build the formatted text
                                $workHoursText = '';
                                foreach ($hoursRanges as $range => $daysList) {
                                    $daysText = implode(', ', $daysList);
                                    $workHoursText .= "$daysText: $range<br />";
                                }
                            @endphp

                            <div class="ps-contact__work">
                                {!! $workHoursText !!}
                            </div>
                            <ul class="ps-social">
                                @if (optional($setting)->facebook_url)
                                    <li>
                                        <a class="ps-social__link facebook"
                                            href="{{ optional($setting)->facebook_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa fa-facebook"></i>
                                            <span class="ps-tooltip">Facebook</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->instagram_url)
                                    <li>
                                        <a class="ps-social__link instagram"
                                            href="{{ optional($setting)->instagram_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa fa-instagram"></i>
                                            <span class="ps-tooltip">Instagram</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->youtube_url)
                                    <li>
                                        <a class="ps-social__link youtube" href="{{ optional($setting)->youtube_url }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="fa fa-youtube-play"></i>
                                            <span class="ps-tooltip">YouTube</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->pinterest_url)
                                    <li>
                                        <a class="ps-social__link pinterest"
                                            href="{{ optional($setting)->pinterest_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa fa-pinterest-p"></i>
                                            <span class="ps-tooltip">Pinterest</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->linkedin_url)
                                    <li>
                                        <a class="ps-social__link linkedin"
                                            href="{{ optional($setting)->linkedin_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa fa-linkedin"></i>
                                            <span class="ps-tooltip">LinkedIn</span>
                                        </a>
                                    </li>
                                @endif

                                <!-- Add additional social media links similarly -->

                                @if (optional($setting)->twitter_url)
                                    <li>
                                        <a class="ps-social__link twitter" href="{{ optional($setting)->twitter_url }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="fa fa-twitter"></i>
                                            <span class="ps-tooltip">Twitter</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->whatsapp_url)
                                    <li>
                                        <a class="ps-social__link whatsapp"
                                            href="{{ optional($setting)->whatsapp_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa fa-whatsapp"></i>
                                            <span class="ps-tooltip">WhatsApp</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="ps-contact__map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d456.45265457796717!2d90.36323376144203!3d23.760882538091433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf65f840a615%3A0x9b7b0e2729349db8!2z4Ka44Kay4Ka_4Kau4KeB4Kay4KeN4Kay4Ka-4Ka5IOCmsOCni-CmoSDgpqrgpr7gpqjgpr_gprAg4Kaf4KeN4Kav4Ka-4KaC4KaV!5e0!3m2!1sen!2sbd!4v1731757458918!5m2!1sen!2sbd"
                                width="600" height="450" style="border: 0" allowfullscreen=""
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('contact.add') }}" method="post">
                @csrf
                <div class="ps-form--contact bg-white p-5">
                    <h2 class="ps-form__title">
                        Fill up the form if you have any question
                    </h2>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="ps-form__group">
                                <input class="form-control ps-form__input" type="text" name="name"
                                    placeholder="Name and Surname" />
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="ps-form__group">
                                <input class="form-control ps-form__input" type="email" name="email"
                                    placeholder="Your E-mail" />
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="ps-form__group">
                                <input class="form-control ps-form__input" type="text" name="phone"
                                    placeholder="Phone" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="ps-form__group">
                                <textarea class="form-control ps-form__textarea" rows="5" name="message" placeholder="Message"
                                    style="border-radius: 8px"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="ps-form__submit">
                        <button type="submit" class="ps-btn ps-btn--warning rounded-pill">Send message</button>
                    </div>
                </div>
            </form>
            {{-- <section class="ps-section--instagram">
                <h3 class="ps-section__title">
                    Follow <strong>@{{ optional($setting) - > website_name }} </strong>on instagram
                </h3>
                <div class="ps-section__content">
                    <div class="row m-0">
                        <div class="col-6 col-md-4 col-lg-2">
                            <a class="ps-image--transition" href="https://www.instagram.com/p/CDf7FC7pwae/">
                                <img src="{{ asset('frontend') }}/img/instagram/instagram1.jpg" alt /><span
                                    class="ps-image__overlay"><i class="fa fa-instagram"></i></span></a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2">
                            <a class="ps-image--transition" href="https://www.instagram.com/p/CDf7D5zJqwo/">
                                <img src="{{ asset('frontend') }}/img/instagram/instagram2.jpg" alt /><span
                                    class="ps-image__overlay"><i class="fa fa-instagram"></i></span></a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2">
                            <a class="ps-image--transition" href="https://www.instagram.com/p/CDf7BnapGmv/">
                                <img src="{{ asset('frontend') }}/img/instagram/instagram3.jpg" alt /><span
                                    class="ps-image__overlay"><i class="fa fa-instagram"></i></span></a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2">
                            <a class="ps-image--transition" href="https://www.instagram.com/p/CDf7Af8JWDj/">
                                <img src="{{ asset('frontend') }}/img/instagram/instagram4.jpg" alt /><span
                                    class="ps-image__overlay"><i class="fa fa-instagram"></i></span></a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2">
                            <a class="ps-image--transition" href="https://www.instagram.com/p/CDf6_QEpWYv/">
                                <img src="{{ asset('frontend') }}/img/instagram/instagram5.jpg" alt /><span
                                    class="ps-image__overlay"><i class="fa fa-instagram"></i></span></a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2">
                            <a class="ps-image--transition" href="https://www.instagram.com/p/CDf69FupFee/">
                                <img src="{{ asset('frontend') }}/img/instagram/instagram6.jpg" alt /><span
                                    class="ps-image__overlay"><i class="fa fa-instagram"></i></span></a>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>
    </div>
</x-frontend-app-layout>
