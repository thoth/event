<a href="#"><?php __('Event'); ?></a>
<ul>
    <li><?php echo $html->link(__('View Events', true), array('controller'=>'events', 'action'=>'index')); ?></li>
    <li><?php echo $html->link(__('Add Event', true), array('controller'=>'events', 'action'=>'add')); ?></li>
</ul>