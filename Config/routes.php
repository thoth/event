<?php
    CroogoRouter::connect('/event/calendar', array('plugin' => 'event', 'controller' => 'event', 'action' => 'calendar'));
    CroogoRouter::connect('/event', array('plugin' => 'event', 'controller' => 'event', 'action' => 'index'));
