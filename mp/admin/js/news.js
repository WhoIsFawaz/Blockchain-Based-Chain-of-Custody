$(document)
		.ready(
				function() {

					getNews();

					function getNews() {
						$
								.ajax({
									url : '../classes/News.php',
									method : 'POST',
									data : {
										GET_NEWS : 1
									},
									success : function(response) {
										console.log(response);
										var resp = $.parseJSON(response);

										if (resp.status == 202) {
											var newsHTML = '';

											$
													.each(
															resp.message,
															function(index,
																	value) {
																newsHTML += '<tr>'
																		+ '<td>'
																		+ value.username
																		+ '</td>'
																		+ '<td>'
																		+ value.datetime
                                    + '</td>'
                                    + '<td>'
																		+ value.title
                                    + '</td>'
                                    + '<td>'
																		+ value.message
																		+ '</td>'
																		+ '<td><a><span style="display:none;">'
																		+ JSON
																				.stringify(value)
																		+ '</span><i></i></a>&nbsp;<a news_id="'
																		+ value.id
																		+ '" class="btn btn-sm btn-danger delete-news"><i class="fas fa-trash-alt"></i></a></td>'
																		+ '</tr>';
															});

											$("#news_list").html(newsHTML);

										} else if (resp.status == 303) {
											$("#news_list").html(resp.message);
										}

									}
								})

					}

					$(".add-news").on("click", function(){

						$.ajax({

							url : '../classes/News.php',
							method : 'POST',
							data : new FormData($("#add-news-form")[0]),
							contentType : false,
							cache : false,
							processData : false,
							success : function(response){
								console.log(response);
								var resp = $.parseJSON(response);
								if (resp.status == 202) {
									$("#add-news-form").trigger("reset");
									$("#add_news_modal").modal('hide');
									getNews();
								}else if(resp.status == 303){
									alert(resp.message);
								}
							}

						});

					});

					$(document.body).on('click', '.delete-news', function() {

						var news_id = $(this).attr('news_id');

						if (confirm("Are you sure to delete this news")) {
							$.ajax({
								url : '../classes/News.php',
								method : 'POST',
								data : {
									DELETE_NEWS : 1,
									news_id : news_id
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
