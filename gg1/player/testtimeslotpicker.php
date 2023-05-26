<!DOCTYPE html>
<html>
<head>
	<title>Time Slot Picker</title>
	<style>
		.time-slot {
			display: inline-block;
			width: 100px;
			height: 50px;
			border: 1px solid #ccc;
			margin: 5px;
			padding: 10px;
			text-align: center;
			cursor: pointer;
			border-radius: 5px;
		}
		.time-slot.selected {
			background-color: #007bff;
			color: #fff;
		}
	</style>
</head>
<body>
	<?php
		// Define available time slots
		$timeSlots = array(
			'8:00am - 10:00am',			
			'10:00am - 12:00pm',			
			'12:00pm - 2:00pm',
			'2:00pm - 4:00pm',						
			'4:00pm - 6:00pm',
			'6:00pm - 8:00pm',
			'8:00pm - 10:00pm',
			'10:00am - 12:00am',			
		);
	?>

	<h1>Choose a Time Slot:</h1>

	<?php foreach ($timeSlots as $timeSlot): ?>
		<div class="time-slot"><?php echo $timeSlot; ?></div>
	<?php endforeach; ?>

	<input type="hidden" name="time_slot" id="time_slot">

	<script>
		// Handle time slot selection
		var timeSlots = document.querySelectorAll('.time-slot');
		var selectedTimeSlot = document.querySelector('#time_slot');
		timeSlots.forEach(function(timeSlot) {
			timeSlot.addEventListener('click', function() {
				// Remove selection from all time slots
				timeSlots.forEach(function(timeSlot) {
					timeSlot.classList.remove('selected');
				});
				// Add selection to clicked time slot
				this.classList.add('selected');
				// Set selected time slot value in hidden input
				selectedTimeSlot.value = this.textContent;
			});
		});
	</script>
</body>
</html>
