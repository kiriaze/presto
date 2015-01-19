/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// z-index
	config.baseFloatZIndex = 102000;
	
	// divbased editor
	config.extraPlugins = 'font';
	
	config.height = '450px';

	config.entities = false;
	
	config.allowedContent = true;
	
	config.forcePasteAsPlainText = true;
	
	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];

	// The default plugins included in the basic setup define some buttons that
	// we don't want too have in a basic editor. We remove them here.
	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Bold,Italic,Subscript,Superscript,Indent,Outdent';

	// Let's have it basic on dialogs as well.
	config.removeDialogTabs = 'link:advanced';
	
	// Load from a list of definitions.
	config.stylesSet = [
		{ name: 'Heading 1', element: 'h1' },
		{ name: 'Heading 2', element: 'h2' },
		{ name: 'Heading 3', element: 'h3' },
		{ name: 'Heading 4', element: 'h4' },
		{ name: 'Heading 5', element: 'h5' },
		{ name: 'Heading 6', element: 'h6' },
	];
};