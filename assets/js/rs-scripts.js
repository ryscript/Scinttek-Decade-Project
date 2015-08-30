/**
 * @desc	This contains all scripts use in site themes
 */
jQuery(document).ready(function($) {

	// Scroll Top
	$(window).scroll(function() {
        if( $(this).scrollTop() > 140 )
			$('#scrollTopWrapper').css({'display':'block'});
		else
			$('#scrollTopWrapper').css({'display':'none'});
	});
	
	$('a#scrollTop').click(function() {
		$('html, body').animate({ scrollTop: 0 }, 600);
		return false;
	});

	//  Responsive Menu
	$(".mobile-menu select.menu-pages").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	
	
	/* SHORTCODES
	*****************************/
	// Accordion
	var gdl_accordion = $('ul.rs-accordion');
	gdl_accordion.find('li').not('.active').each(function(){
		$(this).children('.accordion-content').css('display', 'none');
	});
	gdl_accordion.find('li').click(function(){
		if( $(this).hasClass('active') ){
			$(this).removeClass('active').children('.accordion-content').slideUp();
		} else {
			$(this).addClass('active').children('.accordion-content').slideDown();
			$(this).siblings('li').removeClass('active').children('.accordion-content').slideUp();
		}
	});
	
	// Toggle Box
	var gdl_toggle_box = $('ul.rs-toggle-box');
	gdl_toggle_box.find('li').not('.active').each(function(){
		$(this).children('.toggle-box-content').css('display', 'none');
	});
	gdl_toggle_box.find('li').click(function(){
		if( $(this).hasClass('active') ){
			$(this).removeClass('active').children('.toggle-box-content').slideUp();
		} else {
			$(this).addClass('active').children('.toggle-box-content').slideDown();
		}
	});

	// Tab
	var gdl_tab = $('div.rs-tab');
	gdl_tab.find('li a').click(function(e){
		e.preventDefault();
		
		if( $(this).hasClass('active') ) 
			return;
		
		var data_tab = $(this).attr('data-tab'),
			tab_title = $(this).parents('ul.rs-tab-title'),
			tab_content = tab_title.siblings('ul.rs-tab-content');
		
		// tab title
		tab_title.find('a.active').removeClass('active');
		$(this).addClass('active');
		
		// tab content
		tab_content.find('li.active').removeClass('active').css('display', 'none');
		tab_content.find('li[data-tab="' + data_tab + '"]').fadeIn().addClass('active');
	});
	
});