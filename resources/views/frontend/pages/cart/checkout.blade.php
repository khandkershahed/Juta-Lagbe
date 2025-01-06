<x-frontend-app-layout :title="'Checkout'">
    <div class="ps-checkout">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">
                    Checkout
                </li>
            </ul>
            <h3 class="ps-checkout__title">Checkout</h3>
            <div class="ps-checkout__content">
                {{-- <div class="ps-checkout__wapper">
                    <p class="ps-checkout__text">
                        Returning customer?
                        <a href="my-account.html">Click here to login</a>
                    </p>
                    <p class="ps-checkout__text">
                        Have a coupon?
                        <a href="shopping-cart.html">Click here to enter your code</a>
                    </p>
                </div> --}}
                <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="ps-checkout__form">
                                {{-- <h3 class="ps-checkout__heading">Billing details</h3> --}}
                                <div class="row">
                                    {{-- <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">First name *</label>
                                            <input class="ps-input" type="text" name="billing_first_name"
                                                value="{{ old('billing_first_name', $user->first_name) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Last name *</label>
                                            <input class="ps-input" type="text" name="billing_last_name"
                                                value="{{ old('billing_last_name', $user->last_name) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Email address *</label>
                                            <input class="ps-input" type="email" name="billing_email"
                                                value="{{ old('billing_email', $user->email) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Phone *</label>
                                            <input class="ps-input" type="text" name="billing_phone"
                                                value="{{ old('billing_phone', $user->phone) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">State *</label>
                                            <input class="ps-input" type="text" name="billing_state"
                                                value="{{ old('billing_state', $user->state) }}"/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Postcode *</label>
                                            <input class="ps-input" type="text" name="billing_postcode"
                                                value="{{ old('billing_postcode', $user->zipcode) }}"/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Country (optional)</label>
                                            <select name="billing_country" class="form-select ps-form__input"
                                                id="billing_country">
                                                <option value="Afghanistan" @selected($user->country == 'Afghanistan')>Afghanistan
                                                </option>
                                                <option value="Åland Islands" @selected($user->country == 'Åland Islands')>Åland Islands
                                                </option>
                                                <option value="Albania" @selected($user->country == 'Albania')>Albania</option>
                                                <option value="Algeria" @selected($user->country == 'Algeria')>Algeria</option>
                                                <option value="American Samoa" @selected($user->country == 'American Samoa')>American
                                                    Samoa</option>
                                                <option value="Andorra" @selected($user->country == 'Andorra')>Andorra</option>
                                                <option value="Angola" @selected($user->country == 'Angola')>Angola</option>
                                                <option value="Anguilla" @selected($user->country == 'Anguilla')>Anguilla</option>
                                                <option value="Antarctica" @selected($user->country == 'Antarctica')>Antarctica
                                                </option>
                                                <option value="Antigua and Barbuda" @selected($user->country == 'Antigua and Barbuda')>Antigua
                                                    and Barbuda</option>
                                                <option value="Argentina" @selected($user->country == 'Argentina')>Argentina
                                                </option>
                                                <option value="Armenia" @selected($user->country == 'Armenia')>Armenia</option>
                                                <option value="Aruba" @selected($user->country == 'Aruba')>Aruba</option>
                                                <option value="Australia" @selected($user->country == 'Australia')>Australia
                                                </option>
                                                <option value="Austria" @selected($user->country == 'Austria')>Austria</option>
                                                <option value="Azerbaijan" @selected($user->country == 'Azerbaijan')>Azerbaijan
                                                </option>
                                                <option value="Bahamas" @selected($user->country == 'Bahamas')>Bahamas</option>
                                                <option value="Bahrain" @selected($user->country == 'Bahrain')>Bahrain</option>
                                                <option value="Bangladesh" @selected($user->country == 'Bangladesh') selected>
                                                    Bangladesh
                                                </option>
                                                <option value="Barbados" @selected($user->country == 'Barbados')>Barbados</option>
                                                <option value="Belarus" @selected($user->country == 'Belarus')>Belarus</option>
                                                <option value="Belgium" @selected($user->country == 'Belgium')>Belgium</option>
                                                <option value="Belize" @selected($user->country == 'Belize')>Belize</option>
                                                <option value="Benin" @selected($user->country == 'Benin')>Benin</option>
                                                <option value="Bermuda" @selected($user->country == 'Bermuda')>Bermuda</option>
                                                <option value="Bhutan" @selected($user->country == 'Bhutan')>Bhutan</option>
                                                <option value="Bolivia" @selected($user->country == 'Bolivia')>Bolivia</option>
                                                <option value="Bosnia and Herzegovina" @selected($user->country == 'Bosnia and Herzegovina')>
                                                    Bosnia and Herzegovina</option>
                                                <option value="Botswana" @selected($user->country == 'Botswana')>Botswana
                                                </option>
                                                <option value="Bouvet Island" @selected($user->country == 'Bouvet Island')>Bouvet
                                                    Island</option>
                                                <option value="Brazil" @selected($user->country == 'Brazil')>Brazil</option>
                                                <option value="British Indian Ocean Territory"
                                                    @selected($user->country == 'British Indian Ocean Territory')>British Indian Ocean Territory
                                                </option>
                                                <option value="British Virgin Islands" @selected($user->country == 'British Virgin Islands')>
                                                    British Virgin Islands</option>
                                                <option value="Brunei" @selected($user->country == 'Brunei')>Brunei</option>
                                                <option value="Bulgaria" @selected($user->country == 'Bulgaria')>Bulgaria
                                                </option>
                                                <option value="Burkina Faso" @selected($user->country == 'Burkina Faso')>Burkina Faso
                                                </option>
                                                <option value="Burundi" @selected($user->country == 'Burundi')>Burundi</option>
                                                <option value="Cambodia" @selected($user->country == 'Cambodia')>Cambodia
                                                </option>
                                                <option value="Cameroon" @selected($user->country == 'Cameroon')>Cameroon
                                                </option>
                                                <option value="Canada" @selected($user->country == 'Canada')>Canada</option>
                                                <option value="Cape Verde" @selected($user->country == 'Cape Verde')>Cape Verde
                                                </option>
                                                <option value="Cayman Islands" @selected($user->country == 'Cayman Islands')>Cayman
                                                    Islands</option>
                                                <option value="Central African Republic" @selected($user->country == 'Central African Republic')>
                                                    Central African Republic</option>
                                                <option value="Chad" @selected($user->country == 'Chad')>Chad</option>
                                                <option value="Chile" @selected($user->country == 'Chile')>Chile</option>
                                                <option value="China" @selected($user->country == 'China')>China</option>
                                                <option value="Christmas Island" @selected($user->country == 'Christmas Island')>
                                                    Christmas Island</option>
                                                <option value="Cocos [Keeling] Islands" @selected($user->country == 'Cocos [Keeling] Islands')>
                                                    Cocos [Keeling] Islands</option>
                                                <option value="Colombia" @selected($user->country == 'Colombia')>Colombia
                                                </option>
                                                <option value="Comoros" @selected($user->country == 'Comoros')>Comoros</option>
                                                <option value="Congo - Brazzaville" @selected($user->country == 'Congo - Brazzaville')>Congo
                                                    - Brazzaville</option>
                                                <option value="Congo - Kinshasa" @selected($user->country == 'Congo - Kinshasa')>Congo -
                                                    Kinshasa</option>
                                                <option value="Cook Islands" @selected($user->country == 'Cook Islands')>Cook Islands
                                                </option>
                                                <option value="Costa Rica" @selected($user->country == 'Costa Rica')>Costa Rica
                                                </option>
                                                <option value="Côte d’Ivoire" @selected($user->country == 'Côte d’Ivoire')>Côte
                                                    d’Ivoire</option>
                                                <option value="Croatia" @selected($user->country == 'Croatia')>Croatia</option>
                                                <option value="Cuba" @selected($user->country == 'Cuba')>Cuba</option>
                                                <option value="Cyprus" @selected($user->country == 'Cyprus')>Cyprus</option>
                                                <option value="Czech Republic" @selected($user->country == 'Czech Republic')>Czech
                                                    Republic</option>
                                                <option value="Denmark" @selected($user->country == 'Denmark')>Denmark</option>
                                                <option value="Djibouti" @selected($user->country == 'Djibouti')>Djibouti
                                                </option>
                                                <option value="Dominica" @selected($user->country == 'Dominica')>Dominica
                                                </option>
                                                <option value="Dominican Republic" @selected($user->country == 'Dominican Republic')>
                                                    Dominican Republic</option>
                                                <option value="Ecuador" @selected($user->country == 'Ecuador')>Ecuador</option>
                                                <option value="Egypt" @selected($user->country == 'Egypt')>Egypt</option>
                                                <option value="El Salvador" @selected($user->country == 'El Salvador')>El Salvador
                                                </option>
                                                <option value="Equatorial Guinea" @selected($user->country == 'Equatorial Guinea')>
                                                    Equatorial Guinea</option>
                                                <option value="Eritrea" @selected($user->country == 'Eritrea')>Eritrea</option>
                                                <option value="Estonia" @selected($user->country == 'Estonia')>Estonia</option>
                                                <option value="Ethiopia" @selected($user->country == 'Ethiopia')>Ethiopia
                                                </option>
                                                <option value="Falkland Islands" @selected($user->country == 'Falkland Islands')>Falkland
                                                    Islands</option>
                                                <option value="Faroe Islands" @selected($user->country == 'Faroe Islands')>Faroe
                                                    Islands</option>
                                                <option value="Fiji" @selected($user->country == 'Fiji')>Fiji</option>
                                                <option value="Finland" @selected($user->country == 'Finland')>Finland</option>
                                                <option value="France" @selected($user->country == 'France')>France</option>
                                                <option value="French Guiana" @selected($user->country == 'French Guiana')>French
                                                    Guiana</option>
                                                <option value="French Polynesia" @selected($user->country == 'French Polynesia')>French
                                                    Polynesia</option>
                                                <option value="French Southern Territories"
                                                    @selected($user->country == 'French Southern Territories')>French Southern Territories</option>
                                                <option value="Gabon" @selected($user->country == 'Gabon')>Gabon</option>
                                                <option value="Gambia" @selected($user->country == 'Gambia')>Gambia</option>
                                                <option value="Georgia" @selected($user->country == 'Georgia')>Georgia</option>
                                                <option value="Germany" @selected($user->country == 'Germany')>Germany</option>
                                                <option value="Ghana" @selected($user->country == 'Ghana')>Ghana</option>
                                                <option value="Gibraltar" @selected($user->country == 'Gibraltar')>Gibraltar
                                                </option>
                                                <option value="Greece" @selected($user->country == 'Greece')>Greece</option>
                                                <option value="Greenland" @selected($user->country == 'Greenland')>Greenland
                                                </option>
                                                <option value="Grenada" @selected($user->country == 'Grenada')>Grenada</option>
                                                <option value="Guadeloupe" @selected($user->country == 'Guadeloupe')>Guadeloupe
                                                </option>
                                                <option value="Guam" @selected($user->country == 'Guam')>Guam</option>
                                                <option value="Guatemala" @selected($user->country == 'Guatemala')>Guatemala
                                                </option>
                                                <option value="Guernsey" @selected($user->country == 'Guernsey')>Guernsey
                                                </option>
                                                <option value="Guinea" @selected($user->country == 'Guinea')>Guinea</option>
                                                <option value="Guinea-Bissau" @selected($user->country == 'Guinea-Bissau')>
                                                    Guinea-Bissau</option>
                                                <option value="Guyana" @selected($user->country == 'Guyana')>Guyana</option>
                                                <option value="Haiti" @selected($user->country == 'Haiti')>Haiti</option>
                                                <option value="Heard Island and McDonald Islands"
                                                    @selected($user->country == 'Heard Island and McDonald Islands')>Heard Island and McDonald Islands
                                                </option>
                                                <option value="Honduras" @selected($user->country == 'Honduras')>Honduras
                                                </option>
                                                <option value="Hong Kong SAR China" @selected($user->country == 'Hong Kong SAR China')>Hong
                                                    Kong SAR China</option>
                                                <option value="Hungary" @selected($user->country == 'Hungary')>Hungary</option>
                                                <option value="Iceland" @selected($user->country == 'Iceland')>Iceland</option>
                                                <option value="India" @selected($user->country == 'India')>India</option>
                                                <option value="Indonesia" @selected($user->country == 'Indonesia')>Indonesia
                                                </option>
                                                <option value="Iran" @selected($user->country == 'Iran')>Iran</option>
                                                <option value="Iraq" @selected($user->country == 'Iraq')>Iraq</option>
                                                <option value="Ireland" @selected($user->country == 'Ireland')>Ireland</option>
                                                <option value="Isle of Man" @selected($user->country == 'Isle of Man')>Isle of Man
                                                </option>
                                                <option value="Israel" @selected($user->country == 'Israel')>Israel</option>
                                                <option value="Italy" @selected($user->country == 'Italy')>Italy</option>
                                                <option value="Jamaica" @selected($user->country == 'Jamaica')>Jamaica</option>
                                                <option value="Japan" @selected($user->country == 'Japan')>Japan</option>
                                                <option value="Jersey" @selected($user->country == 'Jersey')>Jersey</option>
                                                <option value="Jordan" @selected($user->country == 'Jordan')>Jordan</option>
                                                <option value="Kazakhstan" @selected($user->country == 'Kazakhstan')>Kazakhstan
                                                </option>
                                                <option value="Kenya" @selected($user->country == 'Kenya')>Kenya</option>
                                                <option value="Kiribati" @selected($user->country == 'Kiribati')>Kiribati
                                                </option>
                                                <option value="Kuwait" @selected($user->country == 'Kuwait')>Kuwait</option>
                                                <option value="Kyrgyzstan" @selected($user->country == 'Kyrgyzstan')>Kyrgyzstan
                                                </option>
                                                <option value="Laos" @selected($user->country == 'Laos')>Laos</option>
                                                <option value="Latvia" @selected($user->country == 'Latvia')>Latvia</option>
                                                <option value="Lebanon" @selected($user->country == 'Lebanon')>Lebanon</option>
                                                <option value="Lesotho" @selected($user->country == 'Lesotho')>Lesotho</option>
                                                <option value="Liberia" @selected($user->country == 'Liberia')>Liberia</option>
                                                <option value="Libya" @selected($user->country == 'Libya')>Libya</option>
                                                <option value="Liechtenstein" @selected($user->country == 'Liechtenstein')>
                                                    Liechtenstein</option>
                                                <option value="Lithuania" @selected($user->country == 'Lithuania')>Lithuania
                                                </option>
                                                <option value="Luxembourg" @selected($user->country == 'Luxembourg')>Luxembourg
                                                </option>
                                                <option value="Macau SAR China" @selected($user->country == 'Macau SAR China')>Macau
                                                    SAR China</option>
                                                <option value="Macedonia" @selected($user->country == 'Macedonia')>Macedonia
                                                </option>
                                                <option value="Madagascar" @selected($user->country == 'Madagascar')>Madagascar
                                                </option>
                                                <option value="Malawi" @selected($user->country == 'Malawi')>Malawi</option>
                                                <option value="Malaysia" @selected($user->country == 'Malaysia')>Malaysia
                                                </option>
                                                <option value="Maldives" @selected($user->country == 'Maldives')>Maldives
                                                </option>
                                                <option value="Mali" @selected($user->country == 'Mali')>Mali</option>
                                                <option value="Malta" @selected($user->country == 'Malta')>Malta</option>
                                                <option value="Marshall Islands" @selected($user->country == 'Marshall Islands')>
                                                    Marshall Islands</option>
                                                <option value="Martinique" @selected($user->country == 'Martinique')>Martinique
                                                </option>
                                                <option value="Mauritania" @selected($user->country == 'Mauritania')>Mauritania
                                                </option>
                                                <option value="Mauritius" @selected($user->country == 'Mauritius')>Mauritius
                                                </option>
                                                <option value="Mayotte" @selected($user->country == 'Mayotte')>Mayotte</option>
                                                <option value="Mexico" @selected($user->country == 'Mexico')>Mexico</option>
                                                <option value="Micronesia" @selected($user->country == 'Micronesia')>Micronesia
                                                </option>
                                                <option value="Moldova" @selected($user->country == 'Moldova')>Moldova</option>
                                                <option value="Monaco" @selected($user->country == 'Monaco')>Monaco</option>
                                                <option value="Mongolia" @selected($user->country == 'Mongolia')>Mongolia
                                                </option>
                                                <option value="Montenegro" @selected($user->country == 'Montenegro')>Montenegro
                                                </option>
                                                <option value="Montserrat" @selected($user->country == 'Montserrat')>Montserrat
                                                </option>
                                                <option value="Morocco" @selected($user->country == 'Morocco')>Morocco</option>
                                                <option value="Mozambique" @selected($user->country == 'Mozambique')>Mozambique
                                                </option>
                                                <option value="Myanmar [Burma]" @selected($user->country == 'Myanmar [Burma]')>Myanmar
                                                    [Burma]</option>
                                                <option value="Namibia" @selected($user->country == 'Namibia')>Namibia</option>
                                                <option value="Nauru" @selected($user->country == 'Nauru')>Nauru</option>
                                                <option value="Nepal" @selected($user->country == 'Nepal')>Nepal</option>
                                                <option value="Netherlands" @selected($user->country == 'Netherlands')>Netherlands
                                                </option>
                                                <option value="Netherlands Antilles" @selected($user->country == 'Netherlands Antilles')>
                                                    Netherlands Antilles</option>
                                                <option value="New Caledonia" @selected($user->country == 'New Caledonia')>New
                                                    Caledonia</option>
                                                <option value="New Zealand" @selected($user->country == 'New Zealand')>New Zealand
                                                </option>
                                                <option value="Nicaragua" @selected($user->country == 'Nicaragua')>Nicaragua
                                                </option>
                                                <option value="Niger" @selected($user->country == 'Niger')>Niger</option>
                                                <option value="Nigeria" @selected($user->country == 'Nigeria')>Nigeria</option>
                                                <option value="Niue" @selected($user->country == 'Niue')>Niue</option>
                                                <option value="Norfolk Island" @selected($user->country == 'Norfolk Island')>Norfolk
                                                    Island</option>
                                                <option value="Northern Mariana Islands"
                                                    @selected($user->country == 'Northern Mariana Islands')>Northern Mariana Islands</option>
                                                <option value="North Korea" @selected($user->country == 'North Korea')>North Korea
                                                </option>
                                                <option value="Norway" @selected($user->country == 'Norway')>Norway</option>
                                                <option value="Oman" @selected($user->country == 'Oman')>Oman</option>
                                                <option value="Pakistan" @selected($user->country == 'Pakistan')>Pakistan
                                                </option>
                                                <option value="Palau" @selected($user->country == 'Palau')>Palau</option>
                                                <option value="Palestinian Territories" @selected($user->country == 'Palestinian Territories')>
                                                    Palestinian Territories</option>
                                                <option value="Panama" @selected($user->country == 'Panama')>Panama</option>
                                                <option value="Papua New Guinea" @selected($user->country == 'Papua New Guinea')>Papua
                                                    New Guinea</option>
                                                <option value="Paraguay" @selected($user->country == 'Paraguay')>Paraguay
                                                </option>
                                                <option value="Peru" @selected($user->country == 'Peru')>Peru</option>
                                                <option value="Philippines" @selected($user->country == 'Philippines')>Philippines
                                                </option>
                                                <option value="Pitcairn Islands" @selected($user->country == 'Pitcairn Islands')>
                                                    Pitcairn Islands</option>
                                                <option value="Poland" @selected($user->country == 'Poland')>Poland</option>
                                                <option value="Portugal" @selected($user->country == 'Portugal')>Portugal
                                                </option>
                                                <option value="Puerto Rico" @selected($user->country == 'Puerto Rico')>Puerto Rico
                                                </option>
                                                <option value="Qatar" @selected($user->country == 'Qatar')>Qatar</option>
                                                <option value="Réunion" @selected($user->country == 'Réunion')>Réunion</option>
                                                <option value="Romania" @selected($user->country == 'Romania')>Romania</option>
                                                <option value="Russia" @selected($user->country == 'Russia')>Russia</option>
                                                <option value="Rwanda" @selected($user->country == 'Rwanda')>Rwanda</option>
                                                <option value="Saint Barthélemy" @selected($user->country == 'Saint Barthélemy')>Saint
                                                    Barthélemy</option>
                                                <option value="Saint Helena" @selected($user->country == 'Saint Helena')>Saint
                                                    Helena</option>
                                                <option value="Saint Kitts and Nevis" @selected($user->country == 'Saint Kitts and Nevis')>
                                                    Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia" @selected($user->country == 'Saint Lucia')>Saint Lucia
                                                </option>
                                                <option value="Saint Martin" @selected($user->country == 'Saint Martin')>Saint
                                                    Martin</option>
                                                <option value="Saint Pierre and Miquelon"
                                                    @selected($user->country == 'Saint Pierre and Miquelon')>Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and the Grenadines"
                                                    @selected($user->country == 'Saint Vincent and the Grenadines')>Saint Vincent and the Grenadines
                                                </option>
                                                <option value="Samoa" @selected($user->country == 'Samoa')>Samoa</option>
                                                <option value="San Marino" @selected($user->country == 'San Marino')>San Marino
                                                </option>
                                                <option value="São Tomé and Príncipe" @selected($user->country == 'São Tomé and Príncipe')>
                                                    São Tomé and Príncipe</option>
                                                <option value="Saudi Arabia" @selected($user->country == 'Saudi Arabia')>Saudi
                                                    Arabia</option>
                                                <option value="Senegal" @selected($user->country == 'Senegal')>Senegal</option>
                                                <option value="Serbia" @selected($user->country == 'Serbia')>Serbia</option>
                                                <option value="Seychelles" @selected($user->country == 'Seychelles')>Seychelles
                                                </option>
                                                <option value="Sierra Leone" @selected($user->country == 'Sierra Leone')>Sierra
                                                    Leone</option>
                                                <option value="Singapore" @selected($user->country == 'Singapore')>Singapore
                                                </option>
                                                <option value="Slovakia" @selected($user->country == 'Slovakia')>Slovakia
                                                </option>
                                                <option value="Slovenia" @selected($user->country == 'Slovenia')>Slovenia
                                                </option>
                                                <option value="Solomon Islands" @selected($user->country == 'Solomon Islands')>Solomon
                                                    Islands</option>
                                                <option value="Somalia" @selected($user->country == 'Somalia')>Somalia</option>
                                                <option value="South Africa" @selected($user->country == 'South Africa')>South
                                                    Africa</option>
                                                <option value="South Georgia" @selected($user->country == 'South Georgia')>South
                                                    Georgia</option>
                                                <option value="South Korea" @selected($user->country == 'South Korea')>South Korea
                                                </option>
                                                <option value="Spain" @selected($user->country == 'Spain')>Spain</option>
                                                <option value="Sri Lanka" @selected($user->country == 'Sri Lanka')>Sri Lanka
                                                </option>
                                                <option value="Sudan" @selected($user->country == 'Sudan')>Sudan</option>
                                                <option value="Suriname" @selected($user->country == 'Suriname')>Suriname
                                                </option>
                                                <option value="Svalbard and Jan Mayen" @selected($user->country == 'Svalbard and Jan Mayen')>
                                                    Svalbard and Jan Mayen</option>
                                                <option value="Swaziland" @selected($user->country == 'Swaziland')>Swaziland
                                                </option>
                                                <option value="Sweden" @selected($user->country == 'Sweden')>Sweden</option>
                                                <option value="Switzerland" @selected($user->country == 'Switzerland')>Switzerland
                                                </option>
                                                <option value="Syria" @selected($user->country == 'Syria')>Syria</option>
                                                <option value="Taiwan" @selected($user->country == 'Taiwan')>Taiwan</option>
                                                <option value="Tajikistan" @selected($user->country == 'Tajikistan')>Tajikistan
                                                </option>
                                                <option value="Tanzania" @selected($user->country == 'Tanzania')>Tanzania
                                                </option>
                                                <option value="Thailand" @selected($user->country == 'Thailand')>Thailand
                                                </option>
                                                <option value="Timor-Leste" @selected($user->country == 'Timor-Leste')>Timor-Leste
                                                </option>
                                                <option value="Togo" @selected($user->country == 'Togo')>Togo</option>
                                                <option value="Tokelau" @selected($user->country == 'Tokelau')>Tokelau</option>
                                                <option value="Tonga" @selected($user->country == 'Tonga')>Tonga</option>
                                                <option value="Trinidad and Tobago" @selected($user->country == 'Trinidad and Tobago')>
                                                    Trinidad and Tobago</option>
                                                <option value="Tunisia" @selected($user->country == 'Tunisia')>Tunisia</option>
                                                <option value="Turkey" @selected($user->country == 'Turkey')>Turkey</option>
                                                <option value="Turkmenistan" @selected($user->country == 'Turkmenistan')>
                                                    Turkmenistan</option>
                                                <option value="Turks and Caicos Islands"
                                                    @selected($user->country == 'Turks and Caicos Islands')>Turks and Caicos Islands</option>
                                                <option value="Tuvalu" @selected($user->country == 'Tuvalu')>Tuvalu</option>
                                                <option value="Uganda" @selected($user->country == 'Uganda')>Uganda</option>
                                                <option value="Ukraine" @selected($user->country == 'Ukraine')>Ukraine</option>
                                                <option value="United Arab Emirates" @selected($user->country == 'United Arab Emirates')>
                                                    United Arab Emirates</option>
                                                <option value="United Kingdom" @selected($user->country == 'United Kingdom')>United
                                                    Kingdom</option>
                                                <option value="Uruguay" @selected($user->country == 'Uruguay')>Uruguay</option>
                                                <option value="U.S. Minor Outlying Islands"
                                                    @selected($user->country == 'U.S. Minor Outlying Islands')>U.S. Minor Outlying Islands</option>
                                                <option value="U.S. Virgin Islands" @selected($user->country == 'U.S. Virgin Islands')>U.S.
                                                    Virgin Islands</option>
                                                <option value="Uzbekistan" @selected($user->country == 'Uzbekistan')>Uzbekistan
                                                </option>
                                                <option value="Vanuatu" @selected($user->country == 'Vanuatu')>Vanuatu</option>
                                                <option value="Vatican City" @selected($user->country == 'Vatican City')>Vatican
                                                    City</option>
                                                <option value="Venezuela" @selected($user->country == 'Venezuela')>Venezuela
                                                </option>
                                                <option value="Vietnam" @selected($user->country == 'Vietnam')>Vietnam</option>
                                                <option value="Wallis and Futuna" @selected($user->country == 'Wallis and Futuna')>Wallis
                                                    and Futuna</option>
                                                <option value="Western Sahara" @selected($user->country == 'Western Sahara')>Western
                                                    Sahara</option>
                                                <option value="Yemen" @selected($user->country == 'Yemen')>Yemen</option>
                                                <option value="Zambia" @selected($user->country == 'Zambia')>Zambia</option>
                                                <option value="Zimbabwe" @selected($user->country == 'Zimbabwe')>Zimbabwe
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Street address *</label>
                                            <input class="ps-input mb-3" type="text" name="billing_address_1"
                                                value="{{ old('billing_address_1', $user->address_one) }}"
                                                placeholder="House number and street name" required />
                                            <input class="ps-input" type="text" name="billing_address_2"
                                                value="{{ old('billing_address_2', $user->address_two) }}"
                                                placeholder="Apartment, suite, unit, etc. (optional)" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="ship-address" />
                                                <label class="form-check-label" for="ship-address">Ship to a different
                                                    address?</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <h3 class="ps-checkout__heading">Shipping details</h3>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">First name *</label>
                                                    <input class="ps-input" type="text"
                                                        value="{{ old('shipping_first_name', $user->first_name) }}"
                                                        name="shipping_first_name" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Last name *</label>
                                                    <input class="ps-input" type="text"
                                                        value="{{ old('shipping_last_name', $user->last_name) }}"
                                                        name="shipping_last_name" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Email address *</label>
                                                    <input class="ps-input" type="email" name="shipping_email"
                                                        value="{{ old('shipping_email', $user->email) }}" required />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Phone *</label>
                                                    <input class="ps-input" type="text" name="shipping_phone"
                                                        value="{{ old('shipping_phone', $user->phone) }}" required />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Full Address *</label>
                                                    <textarea class="ps-textarea" name="shipping_address" id="" rows="2">{{ old('shipping_address', Auth::user()->address_one) }}</textarea>
                                                    {{-- <input class="ps-input mb-3" type="text" name="shipping_address"
                                                        placeholder="House number and street name" /> --}}
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">District </label>
                                                    <input class="ps-input" type="text" name="shipping_state" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Upazila </label>
                                                    <input class="ps-input" type="text" name="shipping_postcode" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Country (optional)</label>
                                                    <select name="shipping_country"
                                                        class="form-select ps-form__input select2-selection--single "
                                                        id="shipping_country">
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                        <option value="India">India</option>
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="Nepal">Nepal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Order notes (optional)</label>
                                            <textarea class="ps-textarea" name="order_note" rows="6"
                                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="ps-checkout__order">
                                <h3 class="ps-checkout__heading">Your order</h3>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Product</div>
                                    <div class="ps-title">Subtotal</div>
                                </div>
                                @foreach ($cartItems as $cartItem)
                                    <div class="ps-checkout__row ps-product">
                                        <div class="ps-product__name">
                                            <a
                                                href="{{ route('product.details', $cartItem->model->slug) }}">{{ $cartItem->model->name }}</a>
                                            x <span>{{ $cartItem->qty }}</span>
                                        </div>
                                        <div class="ps-product__price">
                                            ৳{{ number_format($cartItem->price * $cartItem->qty, 2) }}</div>
                                    </div>
                                @endforeach
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Subtotal</div>
                                    <input type="hidden" name="sub_total" id="sub_total" value="{{ $subTotal }}">
                                    <div class="ps-product__price">৳{{ number_format($subTotal, 2) }}</div>
                                </div>
                                <div class="ps-checkout__row row">
                                    <div class="ps-title col-lg-12">Shipping <span class="text-danger">*</span></div>
                                    <div class="ps-checkout__checkbox col-lg-12">
                                        @if ($subTotal > 3999)
                                            <div class="form-check">
                                                <input class="form-check-input" name="shipping_id" type="radio"
                                                    id="shipping-0" data-shipping_price="0" value="0" checked />
                                                <label class="form-check-label" for="shipping-0">Free Delivery
                                                    <span>(৳ 0)</span></label>
                                            </div>
                                        @else
                                            @foreach ($shippingmethods as $index => $shippingmethod)
                                                <div class="form-check">
                                                    <input class="form-check-input" name="shipping_id" type="radio"
                                                        id="shipping-{{ $shippingmethod->id }}"
                                                        data-shipping_price="{{ $shippingmethod->price }}"
                                                        value="{{ $shippingmethod->id }}" required
                                                        @checked($loop->first) />
                                                    <label class="form-check-label"
                                                        for="shipping-{{ $shippingmethod->id }}">{{ $shippingmethod->title }}
                                                        {{ $shippingmethod->duration }}
                                                        <span>(৳{{ number_format($shippingmethod->price, 2) }})</span></label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Total</div>
                                    <div class="ps-product__price" id="total-price-container">
                                        <input type="hidden" name="total_amount" id="total-input"
                                            value="{{ number_format($subTotal, 2) }}">
                                        ৳<span id="total-price"
                                            style="font-weight: 600;">{{ number_format($subTotal, 2) }}</span>
                                    </div>
                                </div>
                                {{-- <div class="ps-checkout__row">
                                    <div class="ps-title">Total</div>
                                    <div class="ps-product__price" id="total-price-container">

                                        <input type="hidden" name="total_amount" id="total-input"
                                            value="{{ number_format($subTotal, 2) }}">
                                        ৳<span id="total-price"
                                            style="font-weight: 600;">{{ number_format($subTotal, 2) }}</span>
                                    </div>
                                </div> --}}
                                <div class="ps-checkout__payment">
                                    <div class="ps-checkout__row">
                                        <div class="ps-title">Payment Method</div>
                                        <div class="ps-checkout__checkbox">
                                            {{-- <div class="form-check">
                                                <input class="form-check-input" name="payment_method" type="radio"
                                                    id="cod" value="cod" checked />
                                                <label class="form-check-label" for="cod">COD</label>
                                            </div> --}}
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment_method" type="radio"
                                                    id="stripe" value="stripe" checked />
                                                <label class="form-check-label mt-0" for="stripe">Cash On
                                                    Delivery</label>
                                            </div>
                                            {{-- <div class="form-check">
                                                <input class="form-check-input" name="payment_method" type="radio"
                                                    id="paypal" value="paypal" />
                                                <label class="form-check-label" for="paypal">PayPal</label>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="check-faq">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agree-faq" checked
                                                required />
                                            <label class="form-check-label" for="agree-faq">
                                                I have read and agree to the website terms and conditions *</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-4 register-btns">
                                        <i class="fa-solid fa-clipboard-check pr-2"></i>   Place order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subtotal = parseFloat('{{ $subTotal }}');
                const totalInput = document.getElementById('total-input');
                const totalPriceSpan = document.getElementById('total-price');

                document.querySelectorAll('input[name="shipping_id"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        const shippingPrice = parseFloat(this.getAttribute('data-shipping_price')) || 0;
                        const total = subtotal + shippingPrice;

                        console.log('Shipping Price:', shippingPrice);
                        console.log('Calculated Total:', total);

                        totalInput.value = total.toFixed(2);
                        totalPriceSpan.textContent = total.toFixed(2);
                    });
                });
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subtotal = parseFloat('{{ $subTotal }}');
                const totalInput = document.getElementById('total-input');
                const totalPriceSpan = document.getElementById('total-price');

                document.querySelectorAll('input[name="shipping_id"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        const shippingPrice = parseFloat(this.getAttribute('data-shipping_price')) || 0;
                        const total = subtotal + shippingPrice;

                        console.log('Shipping Price:', shippingPrice);
                        console.log('Calculated Total:', total);

                        totalInput.value = total.toFixed(2); // Update hidden field value
                        totalPriceSpan.textContent = total.toFixed(2); // Update the visible total price
                    });
                });
                const defaultShippingRadio = document.querySelector('input[name="shipping_id"]:checked');
                if (defaultShippingRadio) {
                    defaultShippingRadio.dispatchEvent(new Event('change'));
                }

            });
        </script>
    @endpush
</x-frontend-app-layout>
