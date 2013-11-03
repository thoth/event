<?php
    CroogoRouter::connect('/events', array('plugin' => 'event', 'controller' => 'events', 'action' => 'index'));
    CroogoRouter::connect('/events/calendar', array('plugin' => 'event', 'controller' => 'events', 'action' => 'calendar'));
    CroogoRouter::connect('/events/hmtview/*', array('plugin' => 'event', 'controller' => 'events', 'action' => 'hmtview'));
