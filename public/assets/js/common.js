$(function() {
	"use strict";
	skinChanger();
    initSparkline();
    
    setTimeout(function() {
        $('.page-loader-wrapper').fadeOut();
	}, 50);

	$(window).on('load resize', function() {
		if($(window).innerWidth() < 1201) {
            $(".mini-sidebar-btn, .hmenu-btn").attr('disabled', 'disabled');            
		} else {
            $(".mini-sidebar-btn, .hmenu-btn").removeAttr('disabled', 'disabled');            
		}
    });

    $(window).bind("resize", function () {
        console.log($(this).width())
        if ($(this).width() < 1201) {
            $("body.box_layout").removeClass('h-menu');
        } else {
            $("body.box_layout").addClass('h-menu');
        }
    }).trigger('resize');

	
	var values2 = getRandomValues();
	var paramsBar = {
        type: 'bar',
        barWidth: 3,
        height: 15,
        barColor: '#0E9BE2'
    };
    $('#mini-bar-chart1').sparkline(values2[0], paramsBar);
    paramsBar.barColor = '#7CAC25';
    $('#mini-bar-chart2').sparkline(values2[1], paramsBar);
    paramsBar.barColor = '#FF4402';
    $('#mini-bar-chart3').sparkline(values2[2], paramsBar);
	paramsBar.barColor = '#ff9800';

	function getRandomValues() {
        // data setup
        var values = new Array(20);

        for (var i = 0; i < values.length; i++) {
            values[i] = [5 + randomVal(), 10 + randomVal(), 15 + randomVal(), 20 + randomVal(), 30 + randomVal(),
                35 + randomVal(), 40 + randomVal(), 45 + randomVal(), 50 + randomVal()
            ];
        }
        return values;
    }

    function randomVal() {
        return Math.floor(Math.random() * 80);
	}
});

// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};
    
function myFunction() {
	var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
	var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	var scrolled = (winScroll / height) * 100;
	document.getElementById("myBar").style.width = scrolled + "%";
}

// Sparkline
function initSparkline() {
	$(".sparkline").each(function() {
		var $this = $(this);
		$this.sparkline('html', $this.data());
	});

	// Bar charts using inline values
	$('.sparkbar').sparkline('html', { type: 'bar' });	
}

//Skin changer
function skinChanger() {
	$('.choose-skin li').on('click', function() {
	    var $body = $('body');
	    var $this = $(this);
  
	    var existTheme = $('.choose-skin li.active').data('theme');

	    $('.choose-skin li').removeClass('active');
	    $body.removeClass('theme-' + existTheme);
	    $this.addClass('active');
	    var newTheme = $('.choose-skin li.active').data('theme');
	    $body.addClass('theme-' + $this.data('theme'));	
		
	});
}

$(document).ready(function() {	

	// sidebar navigation
	$('#main-menu').metisMenu();

	// sidebar nav scrolling
	$('#left-sidebar .sidebar-scroll').slimScroll({
		height: 'calc(100vh - 65px)',
		wheelStep: 10,
		touchScrollStep: 50,
		color: '#1c222c',
		size: '2px',
		borderRadius: '3px',
		alwaysVisible: false,
		position: 'right',
	});

	// toggle fullwidth layout
	$('.btn-toggle-fullwidth').on('click', function() {
		if(!$('body').hasClass('layout-fullwidth')) {
			$('body').addClass('layout-fullwidth');
			$(this).find(".fa").toggleClass('fa-arrow-left fa-arrow-right');

		} else {
			$('body').removeClass('layout-fullwidth');
			$(this).find(".fa").toggleClass('fa-arrow-left fa-arrow-right');
		}
	});

	// off-canvas menu toggle
	$('.btn-toggle-offcanvas').on('click', function() {
		$('body').toggleClass('offcanvas-active');
	});

	$('#main-content').on('click', function() {
		$('body').removeClass('offcanvas-active');
	});

	$('.right_toggle, .overlay').on('click', function() {
		$('#rightbar').toggleClass('open');
		$('.overlay').toggleClass('open');
	});

	// Theme Setting 
	$('.themesetting .theme_btn').on('click', function() {
		$('.themesetting').toggleClass('open');
	});

	$('.search_toggle').on('click', function() {
		$('.search_div').toggleClass('open');
	});

	$('.megamenu_toggle').on('click', function() {
		$('#megamenu').toggleClass('open');
	});

	// right chat bar 
	$(".rightbar .right_chat li a, .rightbar .back_btn").on('click', function(){
        $("#rightbar").toggleClass("detail");
    });

	// Bootstrap tooltip init
	if($('[data-toggle="tooltip"]').length > 0) {
		$('[data-toggle="tooltip"]').tooltip();
	}

	if($('[data-toggle="popover"]').length > 0) {
		$('[data-toggle="popover"]').popover();
	}

	$(window).on('load', function() {
		// for shorter main content
		if($('#main-content').height() < $('#left-sidebar').height()) {
			$('#main-content').css('min-height', $('#left-sidebar').innerHeight() - $('footer').innerHeight());
		}
	});
    
    // Full screen class 
	$('.full-screen').on('click', function() {
		$(this).parents('.card').toggleClass('fullscreen');
	});

	// progress bars
    $('.progress .progress-bar').progressbar({
		display_text: 'none'
	});	

	// header dropdown add new class
	$('.header-dropdown .dropdown-toggle').on('click', function() {
		$('.header-dropdown li .dropdown-menu').toggleClass('vivify fadeIn');
	});

	// Select all checkbox
	$('.check-all').on('click',function(){
	
		if(this.checked){
			$(this).parents('.check-all-parent').find('.checkbox-tick').each(function(){
			this.checked = true;
			});
		}else{
			$(this).parents('.check-all-parent').find('.checkbox-tick').each(function(){
			this.checked = false;
			});
		}
	});

	$('.checkbox-tick').on('click',function(){   
		if($(this).parents('.check-all-parent').find('.checkbox-tick:checked').length == $(this).parents('.check-all-parent').find('.checkbox-tick').length){
			$(this).parents('.check-all-parent').find('.check-all').prop('checked',true);
		}else{
			$(this).parents('.check-all-parent').find('.check-all').prop('checked',false);
		}
	});

	// inbox star
	$('a.mail-star').on('click', function () {
		$(this).toggleClass('active')
	});

	// todo list js
	$('.todo_list .todo-delete').on('click', function() {
		$(this).parents("li:first").toggleClass('delete');
	});

	// Font Setting 
	$('.font_setting input:radio').click(function () {
		var others = $("[name='" + this.name + "']").map(function () {
			return this.value
		}).get().join(" ")
		console.log(others)
		$('body').removeClass(others).addClass(this.value)
	});

	// light version js
	$(".setting_switch .lv-btn").on('change',function() {
		if(this.checked) {
			$('body').addClass('light_version');
		}else{
			$('body').removeClass('light_version');
		}
	});

	// Mini side bar menu js
	$(".setting_switch .mini-sidebar-btn").on('change',function() {
		if(this.checked) {
			$('body').addClass('mini_sidebar');
			$('#left-sidebar').addClass('mini_sidebar_on');
			$(".hmenu-btn").attr('disabled', 'disabled');
		}else{
			$('body').removeClass('mini_sidebar');
			$('#left-sidebar').removeClass('mini_sidebar_on');
			$(".hmenu-btn").removeAttr('disabled', 'disabled');
		}
	});
	
	$("#left-sidebar").hover(function () {
		$('body').toggleClass("mini_hover");
		$('#left-sidebar').toggleClass('mini_sidebar_on');
	});

	// horizontal menu js
	$(".setting_switch .hmenu-btn").on('change',function() {
		if(this.checked) {
			$('body').addClass('h-menu');
			$(".mini-sidebar-btn").attr('disabled', 'disabled');
		}else{
			$('body').removeClass('h-menu');
			$(".mini-sidebar-btn").removeAttr('disabled', 'disabled');
		}
	});
	// RTL Version
	$(".setting_switch .rtl-btn").on('change',function() {
		if(this.checked) {
			$('body').addClass('rtl');
		}else{
			$('body').removeClass('rtl');
		}
	});	
});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});
};