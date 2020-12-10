window.onload = function(){
	// step-1 ajax request
	showTeams("api/team?page=1");
}

// create team
$(document).ready(function(){
	$(".create-team-form").submit(function(e){
		e.preventDefault();
		var token = $("body").attr("token");
		// start random color

		var colors = ["erpbg-primary","erpbg-secondary","erpbg-success","erpbg-info","erpbg-danger","erpbg-warning"];
		var index = Math.floor(Math.random()*5);
		var erpbg = colors[index];
		// end random color

		$.ajax({
			type: "POST",
			url: "api/team",
			data: {
				_token: token,
				team_name: $(".team-name").val(),
				team_description : $(".team-description").val(),
				team_creator: $(".team-creator").val(),
				team_creator_role: $(".team-creator-role").val(),
			},
			beforeSend: function(){
				$(".fullpage-loader").removeClass("d-none");
				$("#createTeamModal").modal('hide');
				$(".team-name").val("");
				$(".team-description").val("");
			},
			success: function(response){
				$(".fullpage-loader").addClass("d-none");
				var team_name = response.data.team_name;
				var team_description = response.data.team_description;
				var card = document.createElement("DIV");
				card.className = "card my-4 border-0";

				var card_header = document.createElement("DIV");
				card_header.className = "card-header "+erpbg+" text-white";
				card_header.innerHTML = team_name;

				var card_body = document.createElement("DIV");
				card_body.className = "card-body border border-top-0";
				card_body.innerHTML = team_description;

				$(card).append(card_header);
				$(card).append(card_body);
				$(".teams-area").append(card);



			},
			error: function(ajax,error,response){
				$(".fullpage-loader").addClass("d-none");
				$("#createTeamModal").modal('hide');

				var alert = document.createElement("DIV");
				alert.className = "alert erpbg-warning d-flex align-items-center";
				if(ajax.status == 500)
				{
					$(".duplicate-teamname").removeClass("d-none");
					$("[name=team_name]").addClass("animate__animated animate__shakeX");

					// remove duplicate message
					$("[name=team_name]").click(function(){
						$(".duplicate-teamname").addClass("d-none");
						$("[name=team_name]").removeClass("animate__animated animate__shakeX");
					});
				}

				if(ajax.status == 404)
				{
					alert.innerHTML = "<span class='material-icons mr-2'>error</span>"+response.notice;
					$(".teams-message").append(alert);

					// remove after 3 second
					setInterval(function(){
						alert.remove();
					},3000);
				}
			}
		});
	});
});

// show teams
function showTeams(url){
	var token = $("body").attr("token");
	$.ajax({
		type: "GET",
		url: url,
		data: {
			_token: token,
			fetch_type: "pagination"
		},
		beforeSend: function(){
			$(".teams-loader").removeClass("d-none");
		},
		success: function(response)
		{
			// hide loader
			$(".teams-loader").addClass("d-none");

			$(".teams-area").html("");
			// show pagination number
			var start = response.data.from; 
			var end = response.data.last_page; 
			var total = "Total - "+response.data.total;
			$(".total-teams").html(total);

			// create pagination loop
			var i;
			var ul = document.createElement("UL");
			ul.className = "pagination";
			for(i=start;i<=end;i++)
			{
				var li = document.createElement("LI");
				li.className = "page-item";
				$(ul).append(li);

				var a = document.createElement("A");
				a.className = "page-link";
				a.innerHTML = i;
				a.href = "api/team?page="+i;
				$(li).append(a);

				// get data on click
				$(a).click(function(e){
					e.preventDefault();
					showTeams($(this).attr("href"));
				});
			}
			if($(".teams-pagination").html() == "")
			{
				$(".teams-pagination").append(ul);

			}

			var colors = ["erpbg-primary","erpbg-secondary","erpbg-success","erpbg-info","erpbg-danger","erpbg-warning"];
			response.data.data.forEach(function(data){
				var index = Math.floor(Math.random()*5);
				var erpbg = colors[index];
				var team_name = data.team_name;
				var team_description = data.team_description;
				var card = document.createElement("DIV");
				card.className = "card my-4 border-0";

				var card_header = document.createElement("DIV");
				card_header.className = "card-header "+erpbg+" text-white";
				card_header.innerHTML = team_name;

				var card_body = document.createElement("DIV");
				card_body.className = "card-body border border-top-0";
				card_body.innerHTML = team_description;

				$(card).append(card_header);
				$(card).append(card_body);
				$(".teams-area").append(card);

			});

			// step-2 ajax request
			if($(".show-jobroles").html() == "")
			{
				// request data in ascending order
				showJobRoles("asc");
			}
		}
	});
}

// load team name in add role
$(document).ready(function(){
	$("#job-role").on("show.bs.collapse",function(){
		var token = $("body").attr("token");
		var all_option = $(".select-team-name option");
		if(all_option.length == 1)
		{
			$.ajax({
				type: "GET",
				url: "api/team",
				data: {
					_token : token,
					fetch_type: "getonlyteamname"
				},
				success: function(response)
				{
					response.data.forEach(function(data){
						var team_name = data.team_name;
						var option = document.createElement("OPTION");
						option.innerHTML = team_name;
						$(".select-team-name").append(option);
					});
				}
			});
		}
	});
});

// insert job role
$(document).ready(function(){
	$(".job-role-form").submit(function(e){
		e.preventDefault();

		// check update and insert request
		var role = $(".edit-jobrole-submit-btn").attr("role");
		var id = $("[name=id]").val();
		var type = "";
		var url = "";
		if(role == "insert")
		{
			type = "POST";
			url = "api/jobrole";
		}

		if(role == "update")
		{
			type = "PUT";
			url = "api/jobrole/"+id;
		}

		$.ajax({
			type: type,
			url: url,
			data: {
				_token: $("body").attr("token"),
				id: id,
				job_role: $("[name=job_role]").val(),
				qualifications: $("[name=qualifications]").val(),
				certifications: $("[name=certifications]").val(),
				experience: $("[name=experience]").val(),
				salary: $("[name=salary]").val(),
				team_name: $(".select-team-name").val(),
			},
			success: function(response)
			{
				// collapse add role form
				$("#job-role form").trigger('reset');
				$("#job-role").collapse('hide');

				// request data in descending order
				showJobRoles("desc");
			},
			error: function(xhr){
				if(xhr.status == 500)
				{
					$(".duplicate-jobrole").removeClass("d-none");
					$("[name=job_role]").addClass("animate__animated animate__shakeX");
				
					// remove duplicate message after click
					$("[name=job_role]").click(function(){
						$(".duplicate-jobrole").addClass("d-none");
						$("[name=job_role]").removeClass("animate__animated animate__shakeX");
					});
				}
			}
		});
	});
});

// show job roles
function showJobRoles(arrange_by){
	var token = $("body").attr("token");
	$.ajax({
		type: "GET",
		url: "api/jobrole",
		data: {
			_token: token,
			fetch_type: "pagination",
			arrange_by: arrange_by
		},
		beforeSend: function(){
			$(".jobroles-loader").removeClass("d-none");
		},
		success: function(response)
		{
			// prevent from extra append
			$(".show-jobroles").html("");

			// hide loader
			$(".jobroles-loader").addClass("d-none");

			// show total job roles
			var total = "Total - "+response.data.total;
			$(".total-roles").html(total);
			
			// create table
				var table = document.createElement("TABLE");
				table.className = "table table-bordered text-center mt-4";
				var th_row = document.createElement("TR");
				var th_jobrole = document.createElement("TH");
				var th_salary = document.createElement("TH");
				var th_teamname = document.createElement("TH");
				var th_action = document.createElement("TH");

				th_jobrole.innerHTML = "Role";
				th_salary.innerHTML = "Salary";
				th_teamname.innerHTML = "Work As";
				th_action.innerHTML = "A";

				$(th_row).append(th_jobrole);
				$(th_row).append(th_salary);
				$(th_row).append(th_teamname);
				$(th_row).append(th_action);

				$(table).append(th_row);
				$(".show-jobroles").append(table);


			response.data.data.forEach(function(data,index){
				var job_role = data.job_role;
				var salary = data.salary;
				var team_name = data.team_name;

				var tr = document.createElement("TR");
				var td_jobrole = document.createElement("TD");
				var td_salary = document.createElement("TD");
				var td_teamname = document.createElement("TD");
				var td_action = document.createElement("TD");

				td_jobrole.innerHTML = job_role;
				td_salary.innerHTML = salary;
				td_teamname.innerHTML = team_name;
				td_action.innerHTML = "<button class='btn p-0 edit-jobrole' data='"+JSON.stringify(data)+"'><span class='material-icons'>create</span></button>";

				$(tr).append(td_jobrole);
				$(tr).append(td_salary);
				$(tr).append(td_teamname);
				$(tr).append(td_action);

				$(table).append(tr);

				// highlight newly created row when add role performed
				if(index == 0 && arrange_by == "desc")
				{
					$(tr).addClass("erpbg-info animate__animated animate__shakeX");
					
					// remove highlight effect
					setTimeout(function(){
						$(tr).removeClass("erpbg-info animate__animated animate__shakeX");
					},2000);
				}


			});

			// edit jobrole
			$(".edit-jobrole").each(function(){
				$(this).click(function(){
					var all_data = $(this).attr("data");
					all_data = JSON.parse(all_data);

					var id = all_data.id;
					var job_role = all_data.job_role;
					var qualifications = all_data.qualifications;
					var certifications = all_data.certifications;
					var experience = all_data.experience;
					var salary = all_data.salary;
					var team_name = all_data.team_name;

					if($("#job-role").collapse('show'))
					{
						// write data to input field
						$("[name=id]").val(id);
						$("[name=job_role]").val(job_role);
						$("[name=qualifications]").val(qualifications);
						$("[name=certifications]").val(certifications);
						$("[name=experience]").val(experience);
						$("[name=salary]").val(salary);
						$("[name=team_name]").val(team_name);
					}

					else{
						$("#job-role").collapse('show');
						// write data to input field
						$("[name=id]").val(id);
						$("[name=job_role]").val(job_role);
						$("[name=qualifications]").val(qualifications);
						$("[name=certifications]").val(certifications);
						$("[name=experience]").val(experience);
						$("[name=salary]").val(salary);
						$("[name=team_name]").val(team_name);

					}
					
					$(".edit-jobrole-submit-btn").html("Save Changes");

					$(".edit-jobrole-submit-btn").attr("role","update");

					
				});
			});

			// step-3 ajax request
			var limit = 4;
			var url = "api/employee?page=1";
			var findby = "";
			showEmployees(limit,url,findby);
		}
	});
}

// show job roles in employee registration area
$(document).ready(function(){
	$("#add-employee").on("show.bs.collapse",function(){
		var token = $("body").attr("token");
		var all_option = $(".select-job-role option");
		if(all_option.length == 1)
		{
			$.ajax({
				type: "GET",
				url: "api/jobrole",
				data: {
					_token : token,
					fetch_type: "get-jobrole-with-salary"
				},
				success: function(response)
				{

					response.data.forEach(function(data){
						var job_role = data.job_role;
						var salary = data.salary;
						var option = document.createElement("OPTION");
						option.innerHTML = job_role;
						$(option).attr("salary",salary);
						$(".select-job-role").append(option);
					});
				}
			});
		}
	});
});

// set salary according to job role
$(document).ready(function(){
	$(".select-job-role").on("change",function(){
		var option_index = this.selectedIndex;
		var option = $(".select-job-role option");
		var salary = $(option[option_index]).attr("salary");
		$("input[name=salary]").val(salary);
	})
});

// add required attribute to worked before field
$(document).ready(function(){
	$("#agree-form").on("show.bs.collapse",function(){
		var input = $("#agree-form input");
		$(input).each(function(){
			$(this).attr("required","required");
		});
	});
});

// remove required attribute to worked before field
$(document).ready(function(){
	$("#agree-form").on("hide.bs.collapse",function(){
		var input = $("#agree-form input");
		$(input).each(function(){
			$(this).removeAttr("required");
		});
	});
});

// validate upload input from employee registration area
$(document).ready(function(){
	$("#add-employee input[type=file]").each(function(){
		$(this).on("change",function(){
			var file = this.files[0];
			var file_size = file.size;
			var file_type = file.type;

			// validate file size
			if(file_size < 3145728)
			{
				if(file_type == "image/jpeg" || file_type == "image/png" || file_type == "image/gif" || file_type == "image/jpg")
				{
					if($(this).next().hasClass("upload-message"))
					{
						$(this).next().remove();
					}
				}

				else{
					if(!$(this).next().hasClass("upload-message"))
					{
						$("<div class='upload-message d-flex align-items-center'><span class='material-icons text-danger mt-1' style='font-size:17px'>error</span><span class='text-danger quicksand-font mt-1'>Please Upload Image File Only</span></div>").insertAfter(this);
						$(".upload-message").each(function(){
							$(this).prev().val("");
							if($(this).prev().prev().hasClass("employee-avatar"))
							{
								$(this).prev().prev().attr("src","assets/images/employee-avatar.png");
							}
						});
					}	
				}
			}

			else{
				if(!$(this).next().hasClass("upload-message"))
				{
					$("<div class='upload-message d-flex align-items-center'><span class='material-icons text-danger mt-1' style='font-size:17px'>error</span><span class='text-danger quicksand-font mt-1'>Upload Limit Less Than 3MB</span></div>").insertAfter(this);
				}				
			}

		});
	});
});

// validate employee pic
$(document).ready(function(){
	$(".employee-pic").on("change",function(){
		var file = this.files[0];
		var file_size = file.size;
		var file_type = file.type;

		// validate filesize 50kb
		if(file_size > 102400)
		{
			alert("Large");
		}

		else{
			if(file_type == "image/jpg" || file_type == "image/jpeg" || file_type == "image/png" || file_type == "image/gif")	
			{
				var url = URL.createObjectURL(file);
				$(".employee-avatar").attr("src",url);
				$(".employee-avatar").css({
					width: "100%",
				});
			}

		}
	});
});

// validate salary sleep
$(document).ready(function(){
	$(".salary-sleep").on("change",function(){
		var file = this.files;
		var allfilesize = 0;
		var i;
		if(file.length == 4)
		{
			for(i=0;i<file.length;i++)
			{
				allfilesize += file[i].size;
			}

			// validate filesize 12mb
			if(allfilesize > 12582912)
			{
				$(this).val("");
				alert("Filesize too large total upload limit 12mb");
			}



		}

		else{
			$(this).val("");
			alert("Upload 4 copies of salary sleep");
		}
	});
});

// show employess

function showEmployees(limit,url,findby){ 
	var token = $("body").attr("token");

	$.ajax({
		type: "GET",
		url: url,
		data: {
			_token: token,
			fetch_type: "pagination",
			limit: limit,
			findby: findby
		},
		success: function(response)
		{
			console.log(response);

			// prevent from extra append
			$("#show-employees .active .row").html("");

			// getting total number of employees
			var total = response.pagination.total;
			$(".total-employees").html(total);

			// prepare next or prev button
			var prev_url = response.pagination.prev_page_url;
			var next_url = response.pagination.next_page_url;

			if(prev_url != null)
			{
				prev_url = prev_url.split("?")[1];
				$(".prev-employee").attr("prev-url","api/employee?"+prev_url);
			}

			if(next_url != null)
			{
				next_url = next_url.split("?")[1];
				$(".next-employee").attr("next-url","api/employee?"+next_url);
			}

			var employee_pics = [];

			response.data.forEach(function(data,index){
				employee_pics[index] = data.employee_pic;
				var name = data.employee_name;
				var job_role = data.job_role;
				var primary_number = data.primary_contact;
				var secondary_number = data.secondary_contact;
				var city = data.city;

				// prepare ui 
				var data = `<div class="col-md-3 text-center animate__animated animate__zoomIn">
				<div class="d-flex flex-column align-items-center">
				<div class="employee-pic-skelton mb-2">
				<div class="employee-pic-skelton-loader"></div>
				</div>
				<span class="text-uppercase font-weight-bold quicksand-font" style="font-size:13px">`+name+`</span>
				<small>-`+job_role+`-</small>
				<div class="d-flex mt-2">
				<button title="Thank You" data-toggle="tooltip"  class="mr-1 btn border rounded-0 d-flex justify-content-center align-items-center" style="width:30px;height:30px">
				<span class="material-icons" style="font-size:15px">call</span>
				</button>

				<button class="mr-1 btn border rounded-0 d-flex justify-content-center align-items-center" style="width:30px;height:30px">
				<span class="material-icons" style="font-size:15px">chat</span>
				</button>


				<button class="btn border rounded-0 d-flex justify-content-center align-items-center" style="width:30px;height:30px">
				<span class="material-icons" style="font-size:15px">fiber_manual_record</span>
				</button>
				</div>
				</div>

				</div>`;

				$("#show-employees .active .row").append(data);

			});

			// load image with lazyload techniques
			function lazyload(index){
				var index = index;
				var image = new Image();
				image.src = employee_pics[index];
				image.width = "100";
				image.height = "100";
				image.onload = function(){

					//set image to container
					var el = $(".employee-pic-skelton");
					el[index].innerHTML = "";
					el[index].append(image);

					if(index<employee_pics.length)
					{
						lazyload(index+1);
					}
				}
			}

			if($(".employee-switch").prop("checked") == true)
			{
				lazyload(0);
			}

			else{
				$(".employee-pic-skelton").each(function(){
					$(this).remove();
				});
			}
			
		},
		error: function(){
			var data = `
			<div class='col-md-12 text-center'>Record Not Found !</div>

			`;

			$("#show-employees .active .row").html(data);
		}
	});
}

// control input field when search by selected
$(document).ready(function(){
	$(".employees-search-by").on("change",function(){
		if($(this).val() == "Search by")
		{
			$(".employee-search-field").attr("disabled",true);
			$(".employee-search-field").attr("placeholder","Choose option from search by");
			$(".employee-search-field").removeClass("pl-0");
			$(".employee-search-field").val("");
		}

		else{
			var index = this.selectedIndex;
			var options = $("option",this);
			var current_option = options[index];

			// read attributes
			var data_type = $(current_option).attr("data-type");
			var data_hint = $(current_option).attr("data-hint");

			// writting type and hint in input field
			$(".employee-search-field").attr("type",data_type);
			$(".employee-search-field").attr("placeholder",data_hint);
			$(".employee-search-field").val("");
			$(".employee-search-field").attr("disabled",false);
			$(".employee-search-field").addClass("pl-0");
		}
	});
});

// show employee with limit
$(document).ready(function(){
	$(".employee-search-limit").on("change",function(){
		var limit = $(this).val();
		var url = "api/employee?page=1";
		var findby = "";
		showEmployees(limit,url,findby);
	});
});

// show next or prev employees
$(document).ready(function(){
	$(".next-employee").click(function(){
		if(this.hasAttribute("next-url"))
		{
			var url = $(this).attr("next-url");
			var limit = $(".employee-search-limit").val();
			var findby = "";
			showEmployees(limit,url,findby);

		}
	});
});

$(document).ready(function(){
	$(".prev-employee").click(function(){
		if(this.hasAttribute("prev-url"))
		{
			var url = $(this).attr("prev-url");
			var limit = $(".employee-search-limit").val();
			var findby = "";
			showEmployees(limit,url,findby);
		}
	});
});

// search employee
$(document).ready(function(){
	$(".employee-search-field").on("input",function(){
		var keyword = $(this).val();
		var limit = $(".employee-search-limit").val();
		var url = "api/employee/"+keyword+"?page=1";
		var findby = $(".employees-search-by").val();
		showEmployees(limit,url,findby);
	});
});

// employee image switch
$(document).ready(function(){
	$(".employee-switch").click(function(){
		var limit = $(".employee-search-limit").val();
		var url = "api/employee?page=1";
		var findby = "";
		showEmployees(limit,url,findby);
	});
});