<!-- Content Wrapper. Contains page content -->
<div class="container content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Members
			<small>Managing Members Data</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<!--------------------------
        | Your Page Content Here |
        -------------------------->
		<div class="table-responsive box container">
			<br>
			<a id="add_button" data-toggle="modal" data-target="#membersModel" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;
				Add</a>
			<br>
			<br>
			<table id="member_data" class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th width="5%">Sr.No.</th>
						<th width="20%">Name</th>
						<th width="20%">Mobile No</th>
						<th width="20%">Email</th>
						<th width="20%">DOB</th>
						<th width="20%">Address</th>
						<th width="5%">Edit</th>
						<th width="5%">Delete</th>
					</tr>
				</thead>


			</table>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div id="membersModel" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="member_form" autocomplete="off">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Members</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<label>First Name</label>
							<input type="text" name="first_name" id="first_name" class="form-control"/>
							<small class="text-danger errors error_first_name"></small>
						</div>
						<div class="col-md-6 col-xs-12">
							<label>Last Name</label>
							<input type="text" name="last_name" id="last_name" class="form-control"/>
							<small class="text-danger errors error_last_name"></small>
						</div>
						<div class="col-md-6 col-xs-12">
							<label>Moblie Number</label>
							<input type="text" name="mobile_no" id="mobile_no" class="form-control"/>
							<small class="text-danger errors error_mobile_no"></small>
						</div>
						<div class="col-md-6 col-xs-12">
							<label>Email</label>
							<input type="text" name="email" id="email" class="form-control"/>
							<small class="text-danger errors error_email"></small>
						</div>
						<div class="col-md-6 col-xs-12">
							<label>DOB</label>
							<input type="text" name="dob" id="dob" class="form-control" placeholder="yyyy-mm-dd"/>
							<small class="text-danger errors error_dob"></small>
						</div>
						<div class="col-md-12 col-xs-12">
							<label>Address</label>
							<input type="text" name="address" id="address" class="form-control"/>
							<small class="text-danger errors error_address"></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="member_id" id="member_id" />
					<input type="hidden" name="action" id="action" value="add" />
					<input type="submit" class="btn btn-success" id="submit" name="submit" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
$(document).ready(function () {

	var d = new Date();
	var year = d.getFullYear() - 5;
	d.setFullYear(year);
	$('#dob').datepicker({ changeYear: true, changeMonth: true, yearRange: '1920:' + year + '', defaultDate: d, format: 'yyyy-mm-dd'});

		$('#mobile_no').change(function(){
			
		});
        
		$('#add_button').click(function () {
			$('.errors').html('');
			$('#email').attr('disabled', false);
            $('#member_form')[0].reset();
            $('.modal-title').text("Add Member");
            $('#action').val("add");
            $('#submit').val("Add");
            $("#first_name").focus();
            
        });

        var dataTable = $('#member_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: '<?php echo site_url(); ?>'+'/members/fetch_members',
                type: "POST"
            },
               "columnDefs":[  
                {  
                     "targets":[0, 6, 7],  
                     "orderable":false,  
					 "searchable": false,
                }  
           ]
        });
        $(document).on('submit', '#member_form', function (event) {
            event.preventDefault();
            $("#first_name").focus();
			$('.errors').html('');
			$.ajax({
				url: '<?php echo site_url(); ?>'+'/members/user_action',
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function (response) {
					var data = JSON.parse(response);
					if(!data.status){
						Object.keys(data.errors).forEach(function(key) {
							if(data.errors[key] !== ''){
								$(".error_"+key).html(data.errors[key]);
							}else{
								$(".error_"+key).html('');
							}

						});
					}else{
						swal({
							position: 'top-end',
							type: 'success',
							title: data.msg,
							showConfirmButton: false,
							timer: 800
							});
						$('#member_form')[0].reset();
						$('#membersModel').modal('hide');
						dataTable.ajax.reload();
						$('.errors').html('');
					}
				}
			});
            
        });
    
        $(document).on('click', '.update', function () {
			$('.errors').html('');
            var member_id = $(this).attr("id");
            $.ajax({
                url: '<?php echo site_url(); ?>'+'/members/fetch_single',
                method: "POST",
                data: {
                    member_id: member_id
                },
                dataType: "json",
                success:function(data){
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#mobile_no').val(data.mobile_no);
                    $('#email').val(data.email);
                    $('#email').attr('disabled', true);
                    $('#dob').val(data.dob);
                    $('#address').val(data.address);
                    $('.modal-title').text("Edit Member");
                    $('#member_id').val(member_id);
                    $('#membersModel').modal('show');
                    $('#action').val("edit");
                    $('#submit').val("Edit");
                }
            })
        });
    
        $(document).on('click', '.delete', function () {
            
            var member_id = $(this).attr("id");
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete Member!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?php echo site_url(); ?>'+ '/members/delete',
                        method:"POST",
                        data:{member_id: member_id},
                        success:function(data)
                        {
                            swal({
                            position: 'top-end',
                            type: 'success',
                            title: data,
                            showConfirmButton: false,
                            timer: 800
                            });
                            dataTable.ajax.reload();
                        }
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                swal({
                    type: 'success',
                    title: 'Member is Not Deleted... :)',
                    text: 'Data of Member is Safe...!!!',
                });
                }
            });
    
    
        });
		
    });
</script>