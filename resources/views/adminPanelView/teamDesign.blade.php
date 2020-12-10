<?php 
  session_start();
?>

@if(!isset($_SESSION['adminAuthentication']))
  <script>
    window.location = "/404";
  </script>
@else
  @extends("../template.adminPanel.adminPanelTemplate")

@section("title")
  WES - Team Design
@endsection

@section("custom-css")
  <link rel="stylesheet" href="lang/css/adminPanel/teamDesign.css?cache=<?php echo time();?>">
@endsection

@section("custom-js")
<script src="lang/js/adminPanel/teamDesign.js?cache=<?php echo time();?>"></script>
@endsection

@section("content")
  <a href="#createTeamModal" data-toggle="modal">
  <span class="material-icons create-team-icon">
  add_circle
  </span>
  </a>
  <!-- start create team modal -->
  <!-- The Modal -->
  <div class="modal fade shadow-lg" id="createTeamModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
      
        <!-- Modal Header -->
        <div class="modal-header erpbg-pink text-white">
          <h5 class="modal-title quicksand-font font-weight-bold">Create Team</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body quicksand-font" style="letter-spacing:1px">
          Manage your employees group by creating a team such as service team, backend team and many more.
          <form class="create-team-form">
            @csrf
            <label class="quicksand-font text-danger mt-4 duplicate-teamname d-none">
          <span class="material-icons float-left mr-1">error</span>
          Duplicate Entry
        </label>
            <input type="text" name="team_name" class="team-name form-control mb-4" placeholder="Enter Team Name"> 

            <input type="hidden" name="team_creator" class="form-control my-4 team-creator" required="required" value="{{$_SESSION['team_creator']}}"> 

            <input type="hidden" name="team_creator_role" class="form-control my-4 team-creator-role" required="required" value="{{$_SESSION['team_role']}}"> 


            <textarea class="form-control mb-4 team-description" rows="3" name="team_description">
              Describe something about team
            </textarea>
            <button class="btn float-right erpbg-pink text-white">Create</button>
          </form>
        </div>
        
       
        
      </div>
    </div>
  </div>
  <!-- end create team modal -->
  <div class="row">
    <div class="col-md-6">
        <div class="card rounded-0 shadow-sm border-0 mb-4">
    <div class="card-body">
      <p class="quicksand-font">Setup job role and salary for employees</p>
      <button class="rounded-0 quicksand-font btn erpbg-pink text-white d-flex align-items-center" data-target="#job-role" data-toggle="collapse">
        <span class="material-icons mr-2">
        post_add
        </span>
      Add Role
    </button>
    <div class="job-role mt-4 collapse" id="job-role">
      <form class="job-role-form">
        @csrf
        <input type="hidden" name="id" value="0">

        <label class="quicksand-font text-danger d-none duplicate-jobrole">
          <span class="material-icons float-left mr-1">error</span>
          Duplicate Entry
        </label>
        <input type="text" name="job_role" placeholder="Enter Job Role" class="form-control rounded-0 mb-4 quicksand-font" style="width:300px" required="required">

        <input type="text" name="qualifications" placeholder="qualifications" class="form-control rounded-0 mb-4 quicksand-font" style="width:300px" required="required">

        <input type="text" name="certifications" placeholder="certifications" class="form-control rounded-0 mb-4 quicksand-font" style="width:300px" required="required">

        <input type="number" name="experience" placeholder="experience" class="form-control rounded-0 mb-4 quicksand-font" style="width:300px" required="required">

        <input type="number" name="salary" placeholder="Salary" class="form-control rounded-0 mb-4 quicksand-font" style="width:300px" required="required">

        <select class="form-control mb-4 rounded-0 select-team-name" style="width:300px" name="team_name">
          <option value="no-team">Part Of Any Team</option>
        </select>

        <button class="btn erpbg-primary text-white quicksand-font rounded-0 edit-jobrole-submit-btn" type="submit" role="insert">
          Set Role
        </button>
      </form>
    </div>
    </div>
  </div>
    </div>
    <div class="col-md-6">
        <div class="card rounded-0 shadow-sm border-0 mb-4">
    <div class="card-body">
      <p class="quicksand-font">Setup job role and salary for employees</p>
      <button class="rounded-0 quicksand-font btn erpbg-primary text-white d-flex align-items-center" data-target="#add-employee" data-toggle="collapse">
        <span class="material-icons mr-2">
        group_add
        </span>
      Add Employee
    </button>
    <div class="job-role mt-4 collapse" id="add-employee">
      <form class="add-employee-form" method="post" action="api/employee" enctype="multipart/form-data">
        @csrf
        <div class="row px-3">
          <div class="col-md-2 px-0">
            <img src="assets/images/employee-avatar.png" class="w-100 employee-avatar">
            <input type="file" accept="image/*" class="employee-pic" name="employee_pic" required="required">
            <small>270PX * 270PX</small>
          </div>
          <div class="col-md-10 pr-0">
            <input type="text" name="employee_name" class="form-control rounded-0 mb-3" placeholder="Employee Name">

            <select name="job_role" class="form-control rounded-0 select-job-role">
              <option salary="0">Select Job Role</option>
            </select>
            <input type="hidden" name="salary" value="0">
          </div>
        </div>

        <div class="row px-3">
          <div class="col-md-6 px-0">
            <div class="from-group my-3">
              <label class="quicksand-font">Residential Proof</label>
              <input type="file" name="residential_proof" class="form-control rounded-0" required="required" accept="image/*">
            </div>
          </div>

          <div class="col-md-6 pr-0">
            <div class="from-group my-3">
              <label class="quicksand-font">Qualification Proof</label>
              <input type="file" name="qualification_proof" class="form-control rounded-0" required="required" accept="image/*">
            </div>
          </div>

          <div class="col-md-6 px-0">
            <div class="from-group">
              <label class="quicksand-font">Certification Proof</label>
              <input type="file" name="certification_proof" class="form-control rounded-0" required="required" accept="image/*">
            </div>
          </div>

          <div class="col-md-6 pr-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Primary Contact</label>
              <input type="text" name="primary_contact" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-6 px-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Secondary Contact</label>
              <input type="text" name="secondary_contact" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-6 pr-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Dob</label>
              <input type="date" name="dob" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-12 px-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Employee Email</label>
              <input type="email" name="employee_email" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-3 px-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Gender</label>
              <select name="gender" class="form-control rounded-0">
                <option>male</option>
                <option>female</option>
                <option>other</option>
              </select>
            </div>
          </div>

          <div class="col-md-9 pr-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Street Address</label>
              <input type="text" name="street_address" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-6 px-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">City</label>
              <input type="text" name="city" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-6 pr-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Pincode</label>
              <input type="number" name="pincode" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-6 px-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">State</label>
              <input type="text" name="state" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-6 pr-0">
            <div class="from-group mb-3">
              <label class="quicksand-font">Country</label>
              <input type="text" name="country" class="form-control rounded-0" required="required">
            </div>
          </div>

          <div class="col-md-12 p-0">
            <div class="from-group mb-3">              
              <input type="checkbox" name="agree" class="rounded-0 agree-checkbox" id="agree-checkbox" data-target="#agree-form" data-toggle="collapse">
              <label class="quicksand-font" for="agree-checkbox">Have You Worked Anywhere Before</label>
            </div>
          </div>         
        </div>

       <div class="row px-3 collapse" id="agree-form">
         <div class="col-md-6 px-0">
           <div class="form-group">
             <label class="quicksand-font">Company Name</label>
             <input type="text" name="company_name" class="form-control rounded-0">
           </div>
         </div>
         <div class="col-md-6 pr-0">
           <div class="form-group">
             <label class="quicksand-font">Experience</label>
             <input type="number" name="experience" class="form-control rounded-0">
           </div>
         </div>

         <div class="col-md-6 px-0">
           <div class="form-group"> 
             <label class="quicksand-font">Salary</label>
             <input type="number" name="previous_salary" class="form-control rounded-0">
           </div>
         </div>
         <div class="col-md-6 pr-0">
           <div class="form-group">
             <label class="quicksand-font">4 Copies Of Salary Sleep</label>
             <input type="file" name="salary_sleep[]" class="form-control rounded-0 salary-sleep" accept="image/*" multiple="multiple">
           </div>
         </div>


       </div>

        <button class="btn erpbg-pink text-white quicksand-font rounded-0 edit-jobrole-submit-btn mt-2" type="submit" role="insert">
          Register
        </button>
      </form>
    </div>
    </div>
  </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card border-0 rounded-0 shadow-sm mb-4">
        <div class="card-body">
          <h6 class="quicksand-font font-weight-bold d-flex justify-content-between">
          TEAMS
          <span class="badge badge-pill badge-info total-teams">Total - 0</span>
          </h6>
          <div class="teams-loader d-none">
            <div class="loader"></div>
          </div>
          <div class="teams-message"></div>
          <div class="teams-area"></div>
          <div class="teams-pagination"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 rounded-0 shadow-sm mb-4">
        <div class="card-body">
          <h6 class="quicksand-font font-weight-bold d-flex justify-content-between">
          JOB ROLES
          <span class="badge badge-pill badge-info total-roles">Total - 0</span>
          </h6>
          <div class="jobroles-loader d-none">
            <div class="loader"></div>
          </div>
          <div class="show-jobroles"></div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card border-0 rounded-0 shadow-sm mb-4">
        <div class="card-body">
          <h6 class="quicksand-font font-weight-bold d-flex justify-content-between">
          EMPLOYEES
          <div class="d-flex">
            <button class="prev-employee btn border p-0 rounded-0 d-flex justify-content-center align-items-center mr-1" style="width:20px;height:20px">
              <span class="material-icons">
                arrow_left
              </span>
            </button>

            <button class="next-employee btn border p-0 rounded-0 d-flex justify-content-center align-items-center" style="width:20px;height:20px">
              <span class="material-icons">
                arrow_right
              </span>
            </button>
          </div>
          </h6>
          <div class="d-flex justify-content-between">
            <select class="employees-search-by form-control border rounded-0" style="width:fit-content">
              <option>Search by</option>
              <option data-type="number" value="id" data-hint="Enter employee id">Emp id</option>
              <option data-type="text" value="employee_name" data-hint="Enter employee name">Emp name</option>
              <option data-type="email" value="employee_email" data-hint="Enter email id">Email id</option>
              <option data-type="number" value="primary_contact" data-hint="Enter mobile number">Mobile</option>
              <option data-type="text" value="city" data-hint="Enter employee city">City</option>
            </select>


            <div class="d-flex flex-grow-1">
              <input type="text" class="form-control rounded-0 border-bottom border-top-0 border-left-0 border-right-0 mx-5 employee-search-field" disabled="disabled" style="border-style:dashed !important" placeholder="Choose option from search by">
            </div>

            <div class="btn-group">
              <button class="form-control border mr-1 rounded-0 d-flex align-items-center">
                <div class="custom-control custom-switch">
                <input type="checkbox" class="employee-switch custom-control-input" id="switch1">
                <label class="custom-control-label" for="switch1">Image</label>
              </div>
              </button>
              <select class="form-control border rounded-0 employee-search-limit" style="width:fit-content">
                <option>4</option>
                <option>12</option>
                <option>16</option>
                <option>20</option>
              </select>
              <button class="form-control border rounded-0 erpbg-navy text-white total-employees">
                0
              </button>
            </div>
          </div>
          <div id="show-employees" class="py-4">
            <div class="active">
              <div class="row">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@endif
