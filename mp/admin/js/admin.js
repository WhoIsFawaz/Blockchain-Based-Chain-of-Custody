$(document)
		.ready(
				function() {

					getAdmins();

					function getAdmins() {
						$
								.ajax({
									url : '../classes/Admin.php',
									method : 'POST',
									data : {
										GET_ADMIN : 1
									},
									success : function(response) {
										console.log(response);
										var resp = $.parseJSON(response);

										if (resp.status == 202) {
											var adminHTML = '';

											$
													.each(
															resp.message,
															function(index,
																	value) {
																adminHTML += '<tr>'
																		+ '<td>'
																		+ value.name
																		+ '</td>'
																		+ '<td>'
																		+ value.email
																		+ '</td>'
																		+ '<td><a><span style="display:none;">'
																		+ JSON
																				.stringify(value)
																		+ '</span><i></i></a>&nbsp;<a admin_id="'
																		+ value.id
																		+ '" class="btn btn-sm btn-danger delete-admin"><i class="fas fa-trash-alt"></i></a></td>'
																		+ '</tr>';
															});

											$("#admin_list").html(adminHTML);

										} else if (resp.status == 303) {
											$("#admin_list").html(resp.message);
										}

									}
								})

					}

					$(document.body).on('click', '.delete-admin', function() {

						var admin_id = $(this).attr('admin_id');

						if (confirm("Are you sure to delete this admin")) {
							$.ajax({
								url : '../classes/Admin.php',
								method : 'POST',
								data : {
									DELETE_ADMIN : 1,
									admin_id : admin_id
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
