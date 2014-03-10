<?php
/**
 * Routes
 *
 * example_routes.php will be loaded in main app/config/routes.php file.
 */
    Croogo::hookRoutes('Event');
/**
 * Behavior
 *
 * This plugin's Example behavior will be attached whenever Node model is loaded.
 */
    //Croogo::hookBehavior('Node', 'Event.Event', array());
	Croogo::hookModelProperty('Node', 'hasOne', array('Event'));

/**
 * Component
 *
 * This plugin's Example component will be loaded in ALL controllers.
 */
    Croogo::hookComponent('Nodes', 'Event.Event');
/**
 * Helper
 *
 * This plugin's Example helper will be loaded via NodesController.
 */
    Croogo::hookHelper('Nodes', 'Event.Event');
/**
 * Admin menu (navigation)
 *
 * This plugin's admin_menu element will be rendered in admin panel under Extensions menu.
 */
//    Croogo::hookAdminMenu('Example');
/**
 * Admin row action
 *
 * When browsing the content list in admin panel (Content > List),
 * an extra link called 'Example' will be placed under 'Actions' column.
 */
//    Croogo::hookAdminRowAction('Nodes/admin_index', 'Event', 'plugin:event/controller:event/action:index/:id');
/**
 * Admin tab
 *
 * When adding/editing Content (Nodes),
 * an extra tab with title 'Example' will be shown with markup generated from the plugin's admin_tab_node element.
 *
 * Useful for adding form extra form fields if necessary.
 */
    Croogo::hookAdminTab('Nodes/admin_add', 'Event', 'event.admin_tab_node_add');
    Croogo::hookAdminTab('Nodes/admin_edit', 'Event', 'event.admin_tab_node');


	CroogoNav::add('settings.children.event', array(
		'title' => 'Events',
		'url' => array(
			'admin' => true,
			'plugin' => 'settings',
			'controller' => 'settings',
			'action' => 'prefix',
			'Event',
		),
	));
