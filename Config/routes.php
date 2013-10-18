<?php
    CroogoRouter::connect('/event/calendar', array('plugin' => 'event', 'controller' => 'event', 'action' => 'calendar'));
    CroogoRouter::connect('/events', array('plugin' => 'event', 'controller' => 'event', 'action' => 'index'));
