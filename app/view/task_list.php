<div class="task-list">
	<table id="task-list-table" class="table-sm table-hover">
		<thead>
			<th>Name</th>
			<th>E-mail</th>
			<th>Description</th>
			<th width="1%">Status</th>
			<? if($_SESSION['adm']) { ?>
				<th>Actions</th>
			<? } ?>

		</thead>
		<tbody>
			<? foreach($tasks as $task) { ?>
				<tr t_id="<?=$task['task_id']?>">
					<td><?=screen($task['user_name']);?></td>
					<td><?=screen($task['user_email']);?></td>
					<td><?=screen($task['description']);?></td>
					<td>
						<? if($task['done'] == 1) { ?>
							<span class="badge badge-success badge-done">Done</span>
						<? } else { ?>
							<span class="badge badge-light badge-in-progress">In progress..</span>
						<? } ?>
						<? if($task['edited'] == 1) { ?>
							<span class="badge badge-info">Edited by administrator</span>
						<? } ?>
					</td>
					<? if($_SESSION['adm']) { ?>
						<td>
							<? if($task['done'] != '1') { ?>
								<a href="#" action="/tasks/confirm" item-id="<?=$task['task_id'];?>" class="check-button"><i class="far fa-check-square"></i></a>
							<? } ?>
							<a href="/tasks/add_edit?id=<?=$task['task_id']; ?>"><i class="far fa-edit"></i></a>
						</td>
					<? } ?>
				</tr>
			<? } ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('#task-list-table').DataTable({
			"pageLength": 3,
			"bFilter" : false,               
			"bLengthChange": false,
			"bInfo" : false,
			"fnDrawCallback":function(){
				if ( $('#task-list-table_paginate span a.paginate_button').length > 1) {
					$('#task-list-table_paginate')[0].style.display = "block";
				} else {
					$('#task-list-table_paginate')[0].style.display = "none";
				}
			}
		});

		$('.task-list').on( 'click', 'a.check-button', function (e){
			e.preventDefault();

			block = $(this).closest('tr').find('td:nth-child(4)');
			check_btn = $(this);
			
			/* ajax */
			$.ajax({
				type: 'GET',
				url: $(this).attr('action'),
				data: {id:$(this).attr('item-id')}
			}).done(function() {
				block.find('span.badge-in-progress').remove();
				block.prepend('<span class="badge badge-success badge-done">Done</span>');
				check_btn.remove();
			}).fail(function() {
				alert('Something goes wrong. Please, contact administrator');
			});
		});
	});
</script>
