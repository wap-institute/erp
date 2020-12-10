// control product type
$(document).ready(function(){
	$(".product-type").on("change",function(){
		if($(this).val() == "Physical Product")
		{
			$(".physical-product").removeClass("d-none");
			$(".digital-product").addClass("d-none");
			$(".subscription-product").addClass("d-none");
			get_group_name("api/physical-stocks-group",".physical-group");
		}

		if($(this).val() == "Digital Product")
		{
			$(".physical-product").addClass("d-none");
			$(".subscription-product").addClass("d-none");
			$(".digital-product").removeClass("d-none");
			get_group_name("api/digital-stocks-group",".digital-group");
		}

		if($(this).val() == "Subscription Product")
		{
			$(".physical-product").addClass("d-none");
			$(".subscription-product").removeClass("d-none");
			$(".digital-product").addClass("d-none");
		}
	});
});

// validate and show product image
$(document).ready(function(){
	$(".product-images").on("change",function(){
		var file = this.files;
		var i;
		if(file.length <= 4)
		{
			for(i=0;i<file.length;i++)
			{
				var url = URL.createObjectURL(file[i]);
				var img = document.createElement("IMG");
				img.src = url;
				img.width = "100";
				img.className = "border shadow-sm mr-2";
				$(".product-images-preview").append(img);
			}
		}

		else{
			alert("Maximum 4 photos allowed !");
		}
		
	});
});

// create group
$(document).ready(function(){
	$(".physical-stocks-group-create").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "/api/physical-stocks-group",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(response){
				show_flash_alert(".physical-stocks-group-message","Group Created !");
				get_group_name();
				removeAlert();
			},
			error: function(xhr)
			{
				if(xhr.status = 409)
				{
					show_flash_alert(".physical-stocks-group-message","Duplicate Entry !");
					removeAlert();
				}
			}
		});
	});
});

// get group name
$(document).ready(function(){
	get_group_name("api/physical-stocks-group",".physical-group");
});

function get_group_name(url,el){
	$.ajax({
		type: "GET",
		url: url,
		data: {
			_token: $("body").attr("token"),
		},
		success: function(response)
		{
			response.data.forEach(function(data){
				var option = document.createElement("OPTION");
				option.innerHTML = data.group_name;
				$(el).append(option);
			});
		},
		error: function(xhr){
			if(xhr.status == 404)
			{
				show_flash_alert(".physical-stocks-group-message","Please Create A Group !");
				removeAlert();
			}
		}
	});
}


// flash alert
function removeAlert(){
	setTimeout(function(){
		$(".flash-alert").remove();
	},5000);
}

function show_flash_alert(el,message){
	var alert = document.createElement("DIV");
	alert.className = "alert erpbg-warning flash-alert";
	alert.innerHTML = "<b>"+message+"</b>";
	$(el).html(alert);
}

// create product
$(document).ready(function(){
	$(".physical-stocks-product-form").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "api/physical-stocks-product",
			data: new FormData(this),
			processData: false,
			contentType: false,
			beforeSend: function(){
				show_flash_alert(".physical-stocks-product-message","Please Wait...");
			},
			success: function(response)
			{
				$(".product-images-preview").html("");
				$(".physical-stocks-product-form").trigger('reset');
				show_flash_alert(".physical-stocks-product-message","Entry Success !");
				removeAlert();
			},
			error: function(xhr)
			{
				if(xhr.status == 409)
				{
					show_flash_alert(".physical-stocks-product-message","Entry Failed Duplicate Product Name !");
					removeAlert();
				}
			}
		});
	});
});

// calculate physical product amount
$(document).ready(function(){
	$(".physical-product-qnt,.physical-product-rate").on("input",function(){
		var qnt = $(".physical-product-qnt").val();
		var rate = $(".physical-product-rate").val();

		$(".physical-product-amount").val(qnt*rate);
	});
});

// create digital stocks
$(document).ready(function(){
	$(".digital-stocks-group-create").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "api/digital-stocks-group",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(response){
				show_flash_alert(".digital-stocks-group-message","Entry Success !");
				removeAlert();
			},
			error: function(xhr)
			{
				if(xhr.status == 409)
				{
					show_flash_alert(".digital-stocks-group-message","Duplicate Entry !");
					removeAlert();
				}
			}
		});
	});
});

// create digital products
$(document).ready(function(){
	$(".digital-stocks-product-form").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "api/digital-stocks-product",
			data: new FormData(this),
			processData: false,
			contentType: false,
			beforeSend: function(){
				show_flash_alert(".digital-stocks-product-message","Please wait...");
			},
			success: function(response)
			{
				show_flash_alert(".digital-stocks-product-message","Entry Success !");
				removeAlert();
			},
			error: function(xhr)
			{
				if(xhr.status == 409)
				{
					show_flash_alert(".digital-stocks-product-message","Duplicate Entry !");
					removeAlert();
				}
			}
		});
	});
});

// add installments policy
$(document).ready(function(){
	$(".installments-btn").click(function(){
		var ota = $(".ota").val();
		if(ota != "")
		{
			var el = `
			<div class='d-flex mb-3'>
			<input type='number' class='form-control rounded-0 no-of-ins' placeholder='No-of-ins' name='ins_no[]'>
			<input type='text' class='form-control rounded-0 prevent-typing' placeholder='00.00' name='each_ins[]'>
			<input type='text' class='form-control rounded-0 prevent-typing' placeholder='00.00' name='amount[]'>
			<button class='form-control rounded-0 ins-delete-btn' style='width:fit-content'><span class='material-icons'>delete</span></button>
			</div>
			`;

			$(".installments-field").append(el);

			// prevent from typing
			$(".prevent-typing").each(function(){
				$(this).on("keyup",function(){
					return false;
				});
			});

			$(".prevent-typing").each(function(){
				$(this).on("keydown",function(){
					return false;
				});
			});

			// remove fields
			$(".ins-delete-btn").each(function(){
				$(this).click(function(){
					var parent = this.parentElement;
					parent.remove();
				});
			});

			// calculate installments
			$(".no-of-ins").each(function(){
				$(this).on("input",function(){
					var no_of_ins = $(this).val();
					var ota = $(".ota").val();
					var parent = this.parentElement;
					var all_input = $("input",parent);

					if(!document.querySelector(".autoincrement-checkbox").checked)
					{
						var each_ins = (ota/no_of_ins).toFixed(1);
						all_input[1].value = each_ins;
						all_input[2].value = each_ins*no_of_ins;
					}

					else{
						$.ajax({
						type: "GET",
						url: "api/installment-increment/"+no_of_ins,
						data: {
							_token: $("body").attr("token")
						},
						success: function(response)
						{
							response.data.forEach(function(data){
								var percentage = data.percentage;
								var ota = Number($(".ota").val());
								var total = ota+(ota*percentage)/100;
								var each_ins = (total/no_of_ins).toFixed(1);
								all_input[1].value = each_ins;
								all_input[2].value = total;
							});
						}
					});
					}
					
				});
			});
		}

		else{
			show_flash_alert(".installments-field","Please Input One Time Amount !");
			removeAlert();
		}
		
	});
});

// autoincrement policy
$(document).ready(function(){
	$(".increment-policy-form").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "api/installment-increment",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(response){
				$(".increment-policy-form").trigger('reset');
				show_flash_alert(".autoincrement-policy-message","Entry Success !");
				removeAlert();
			},
			error: function(xhr)
			{
				if(xhr.status == 409)
				{
					show_flash_alert(".autoincrement-policy-message","Duplicate Entry !");
					removeAlert();
				}
			}
		});
	});
});

// apply increment policy
$(document).ready(function(){
	$(".autoincrement-checkbox").click(function(){
		if(this.checked)
		{
			$(".no-of-ins").each(function(){
				var no_of_ins = $(this).val();
				var parent = this.parentElement;
				var all_input = $("input",parent);
				$.ajax({
					type: "GET",
					url: "api/installment-increment/"+no_of_ins,
					data: {
						_token: $("body").attr("token")
					},
					success: function(response)
					{
						response.data.forEach(function(data){
							var percentage = data.percentage;
							var ota = Number($(".ota").val());
							var total = ota+(ota*percentage)/100;
							var each_ins = (total/no_of_ins).toFixed(1);
							all_input[1].value = each_ins;
							all_input[2].value = total;
						});
					}
				});
			});
		}

		else{
			$(".no-of-ins").each(function(){
				var no_of_ins = $(this).val();
				var ota = Number($(".ota").val());
				var each_ins = (ota/no_of_ins).toFixed(1);
				var parent = this.parentElement;
				var all_input = $("input",parent);
				all_input[1].value = each_ins;
				all_input[2].value = ota;
			});
		}

	});
});

// add subscription prodcuts
$(document).ready(function(){
	$(".subscription-stocks-product-form").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "api/subscription-stocks-product",
			data: new FormData(this),
			processData: false,
			contentType: false,
			beforeSend: function(){
				show_flash_alert(".subscription-stocks-product-message","Please Wait...");
			},
			success: function(response)
			{
				show_flash_alert(".subscription-stocks-product-message","Entry Success !");
				removeAlert();
			},
			error: function(xhr){
				if(xhr.status == 409)
				{
					show_flash_alert(".subscription-stocks-product-message","Duplicate Entry !");
					removeAlert();
				}
			}
		});
	});
});