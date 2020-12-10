@extends("template.default")
@section("title")
Wap Erp Solutions
@endsection
@section("custom-css")
<link rel="stylesheet" href="lang/css/welcome.css?cache=<?php echo time();?>">
@endsection
@section("custom-js")
<script src="lang/js/welcome.js?cache=<?php echo time();?>"></script>
@endsection
@section("content")

<div class="container bg-white shadow-lg my-4">
    <div class="row">
        <div class="col-md-6 p-0 welcome-image"></div>
        
        <div class="col-md-6 py-5 overflow-hidden">
            <div class="branding">
                <h1>WES</h1>
                <p>WAP ERP SOLUTIONS</p>
            </div>
            <div class="welcome-form p-4">
                <form class="signup-from" automcomplete="off" action="/api/company" method="post">
                    @csrf
                    
                    <!-- start step 1 -->
                    <div class="step-1">
                        <div class="form-group mb-4 overflow-hidden">
                            <label class="d-none">Company name</label>
                            <input type="text" name="company_name" class="form-control welcome-form-input rounded-0 required company-name" placeholder="COMPANY NAME" value="wap institute" maxlength="80">
                        </div>

                        <div class="form-group mb-4 overflow-hidden d-none">
                            <label class="d-none">Company slug</label>
                            <input type="text" name="company_slug" class="form-control welcome-form-input rounded-0 company-slug" placeholder="COMPANY SLUG" maxlength="80">
                        </div>

                        <div class="d-none form-group mb-4 overflow-hidden">
                            <label class="d-none">Erp url</label>
                            <input type="url" name="erp_url" class="form-control welcome-form-input rounded-0 erp-url" placeholder="ERP URL">
                        </div>

                        <div class="form-group mb-4 overflow-hidden d-none">
                            <label class="d-none">Password</label>
                            <input type="password" name="password" class="form-control welcome-form-input rounded-0 password" placeholder="PASSWORD" maxlength="9">
                        </div>


                        <div class="form-group mb-4 overflow-hidden">
                            <label class="d-none">Tagline</label>
                            <input type="text" name="tagline" class="form-control welcome-form-input rounded-0" placeholder="TAGLINE" value="an internatinal brand of software engineering education" maxlength="95">
                        </div>
                        
                        <div class="form-group mb-4 overflow-hidden">
                            <label class="d-none">WEBSITE</label>
                            <input type="website" name="website" class="form-control welcome-form-input rounded-0 url" placeholder="WEBSITE" value="https://wapinstitute.com" maxlength="95">
                        </div>
                        <div class="form-group mb-4 overflow-hidden">
                            <label class="d-none">Email</label>
                            <input type="email" name="company_email" class="form-control welcome-form-input rounded-0 required" placeholder="EMAIL ID" value="wapinstitution@gmail.com" maxlength="95">
                        </div>
                        <div class="form-group mb-4 overflow-hidden">
                            <label class="d-none">Founder</label>
                            <input type="text" name="founder" class="form-control welcome-form-input rounded-0 required" placeholder="FOUNDER" value="er saurav" maxlength="80">
                        </div>
                        <div class="form-group mb-5 overflow-hidden">
                            <label class="d-none">Founder email</label>
                            <input type="email" name="founder_email" class="form-control welcome-form-input rounded-0 required" placeholder="FOUNDER EMAIL ID" value="ersaurav08@gmail.com" maxlength="95">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn float-right next-btn step-1-next-btn">
                            NEXT <i class="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                        
                    </div>
                    <!-- end step 1 -->
                    <!-- start step 2 -->
                    <div class="step-2 d-none">
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Contact number</label>
                            <input type="number" name="contact_number" class="form-control welcome-form-input rounded-0 required" placeholder="CONTACT NUMBER" value="9199987267" maxlength="15">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Street address</label>
                            <input type="text" name="street_address" class="form-control welcome-form-input rounded-0 required" placeholder="STREET ADDRESS" value="jiyalal roy road">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">City</label>
                            <input type="text" name="city" class="form-control welcome-form-input rounded-0 required" placeholder="CITY" value="muzaffarpur" maxlength="80">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">State</label>
                            <input type="text" name="state" class="form-control welcome-form-input rounded-0 required" placeholder="STATE" value="bihar" maxlength="80">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">COUNTRY</label>
                            <input type="text" name="country" class="form-control welcome-form-input rounded-0 required" placeholder="COUNTRY" value="india" maxlength="80">
                        </div>
                        <div class="form-group overflow-hidden mb-5">
                            <label class="d-none">Pincode</label>
                            <input type="number" name="pincode" class="form-control welcome-form-input rounded-0 required" placeholder="PINCODE" value="842001" maxlength="15">
                        </div>
                        <div class="form-group overflow-hidden">
                            <button type="submit" class="btn float-left back-btn step-2-back-btn">
                            <i class="fa fa-angle-double-left"></i> BACK
                            </button>
                            <button type="submit" class="btn float-right next-btn step-2-next-btn">
                            NEXT <i class="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                    <!-- end step 2 -->
                    <!-- start step 3 -->
                    <div class="step-3 d-none">
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">GSTIN</label>
                            <input type="text" name="gstin"  placeholder="GSTIN" class="form-control welcome-form-input rounded-0" value="wp46261" maxlength="20"> 
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Office starts at</label>
                            <input type="time" name="office_starts_at" class="form-control welcome-form-input rounded-0 required" value="10:00:00">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Office ends at</label>
                            <input type="time" name="office_ends_at" class="form-control welcome-form-input rounded-0 required" value="06:00:00">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Established in</label>
                            <input type="date" name="company_estd" class="form-control welcome-form-input rounded-0 required">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Facebook page url</label>
                            <input type="url" name="facebook_url" class="form-control welcome-form-input rounded-0 url" placeholder="FACEBOOK PAGE URL" value="https://facebook.com/wapinstitute">
                        </div>
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">Twitter page url</label>
                            <input type="url" name="twitter_url" class="form-control welcome-form-input rounded-0 url" placeholder="TWITTER PAGE URL" value="https://twitter.com/wapinstitute">
                        </div>
                        <div class="form-group overflow-hidden">
                            <button type="submit" class="btn float-left back-btn step-3-back-btn">
                            <i class="fa fa-angle-double-left"></i> BACK
                            </button>
                            <button type="submit" class="btn float-right next-btn step-3-next-btn">
                            NEXT <i class="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                    <!-- end start 3 -->
                    <!-- start step 4 -->
                    <div class="step-4 d-none">
                        <div class="form-group overflow-hidden mb-4">
                            <label class="d-none">What`s app number</label>
                            <input type="number" name="whats_app" class="form-control welcome-form-input rounded-0" placeholder="WHAT`S APP NUMBER" value="9199987267" maxlength="18">
                        </div>
                        <div class="form-group overflow-hidden mb-5">
                            <label>Category</label>
                            <select name="category" class="form-control required">
                                <option>Education</option>
                            </select>
                        </div>
                        <div class="form-group overflow-hidden">
                            <button type="submit" class="btn float-left back-btn step-4-back-btn">
                            <i class="fa fa-angle-double-left"></i> BACK
                            </button>
                            <button type="submit" class="btn float-right submit-btn rounded-0">
                            SUBMIT
                            </button>
                        </div>
                    </div>
                    <!-- end step 4 -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection