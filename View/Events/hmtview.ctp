<div class="content">
	<h3>Event</h3>
	<div class="body">
		<h1><?php echo $event['Event']['name']; ?></h1>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Details'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['description']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['venue_name']; ?>
				&nbsp;
			</dd>
			<?php
				if(strlen($event['Event']['venue_address1']) > 0){
			?>
			<dd<?php if ($i % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['venue_address1']; ?>
				&nbsp;
			</dd>
			<?php
				}
				if(strlen($event['Event']['venue_address2']) > 0){
			?>
			<dd<?php if ($i % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['venue_address2']; ?>
				&nbsp;
			</dd>
			<?php
				}
			?>
			<dd<?php if ($i % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['venue_city'].', '.$event['Event']['venue_state'].' '.$event['Event']['venue_zip']; ?>
				&nbsp;
			</dd>
			<dd<?php if ($i % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['venue_phone']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo date('F jS, Y \a\t g:ia', strtotime($event['Event']['start'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('End'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo date('F jS, Y \a\t g:ia', strtotime($event['Event']['end']));  ?>
				&nbsp;
			</dd>
		</dl>

		<?php
		if(!empty($event['Event']['event_ticket_sales']) && $event['Event']['event_ticket_sales'] == 'y'):
			echo "<div><a class='btn btn-danger btn-large' style='color: #fff;' href='https://holdmyticket.com/checkout/event/".$event['Event']['id']."'>BUY TICKETS</a></div><br /><br />";
		endif;
		?>

		<?php echo $this->Html->link('Return to Events Calendar', '/events'); ?>
	</div>
</div>
