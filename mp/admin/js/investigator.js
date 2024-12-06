$(document)
		.ready(
				function() {

					getInvestigators();

					function getInvestigators() {
						$
								.ajax({
									url : '../classes/Investigator.php',
									method : 'POST',
									data : {
										GET_Investigator : 1
									},
									success : function(response) {
										console.log(response);
										var resp = $.parseJSON(response);

										if (resp.status == 202) {
											var InvestigatorHTML = '';

											$
													.each(
															resp.message,
															function(index,
																	value) {
																InvestigatorHTML += '<tr>'
																		+ '<td>'
																		+ value.name
																		+ '</td>'
																		+ '<td>'
																		+ value.email
																		+ '</td>'
																		+ '<td>'
																		+ value.address
																		+ '</td>'
																		+ '<td>'
																		+ value.phone
																		+ '</td>'
																		+ '<td>'
																		+ value.branch
																		+ '</td>'
																		+ '<td><a class="btn btn-sm btn-info edit-investigator" style="color:#fff;"><span style="display:none;">'
																		+ JSON
																				.stringify(value)
																		+ '</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a Investigator_id="'
																		+ value.id
																		+ '" class="btn btn-sm btn-danger delete-Investigator"><i class="fas fa-trash-alt"></i></a></td>'
																		+ '</tr>';
															});

											$("#Investigator_list").html(InvestigatorHTML);

										} else if (resp.status == 303) {
											$("#Investigator_list").html(resp.message);
										}

									}
								})

					}

					$(document.body).on('click', '.edit-investigator', function(){
						var investigator = $.parseJSON($.trim($(this).find('span').text()));

						$("input[name='e_investigator_name']").val(investigator.name);
						$("input[name='e_investigator_email']").val(investigator.email);
						$("input[name='e_investigator_address']").val(investigator.address);
						$("input[name='e_investigator_phone']").val(investigator.phone);
						$("input[name='e_investigator_branch']").val(investigator.branch);
						$("input[name='Investigator_id']").val(investigator.id);
						$("#edit_investigator_modal").modal('show');

					});

					$(".submit-edit-investigator").on('click', function(){

						$.ajax({

							url : '../classes/Investigator.php',
							method : 'POST',
							data : new FormData($("#edit-investigator-form")[0]),
							contentType : false,
							cache : false,
							processData : false,
							success : function(response){
								console.log(response);
								var resp = $.parseJSON(response);
								if (resp.status == 202) {
									$("#edit-investigator-form").trigger("reset");
									$("#edit_investigtor_modal").modal('hide');
									alert(resp.message);
									location.reload();
								}else if(resp.status == 303){
									alert(resp.message);
								}
							}

						});


					});

					$(document.body).on('click', '.delete-Investigator', function() {

						var Investigator_id = $(this).attr('Investigator_id');

						if (confirm("Are you sure to delete this Investigator")) {
							$.ajax({
								url : '../classes/Investigator.php',
								method : 'POST',
								data : {
									DELETE_Investigator : 1,
									Investigator_id : Investigator_id
								},
								success : function(response) {
									var resp = $.parseJSON(response);
									if (resp.status == 202) {
										alert(resp.message);
										location.reload();
									} else if (resp.status == 303) {
										alert(resp.message);
									}
								}
							});
						} else {
							alert('Cancelled');
						}

					});

				});
