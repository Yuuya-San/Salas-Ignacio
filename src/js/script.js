(function ($) {

	"use strict";

	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if ($('.loader-wrap').length) {
			$('.loader-wrap').delay(1000).fadeOut(500);
		}
	}

	if ($(".preloader-close").length) {
		$(".preloader-close").on("click", function () {
			$('.loader-wrap').delay(200).fadeOut(500);
		})
	}

	if ($(".switch_btn_one").length) {
		$(".search__toggler").on("click", function () {
			$(".search-field .switch_btn_one").addClass("active");
		})
		$(".switch_btn_one .close-btn").on("click", function () {
			$(".search-field .switch_btn_one").removeClass("active");
		})
	}

	//Update Header Style and Scroll to Top
	function headerStyle() {
		if ($('.main-header').length) {
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-top');
			if (windowpos >= 110) {
				siteHeader.addClass('fixed-header');
				scrollLink.addClass('open');
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.removeClass('open');
			}
		}
	}

	headerStyle();


	//Submenu Dropdown Toggle
	if ($('.main-header li.dropdown ul').length) {
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');

	}

	//Mobile Nav Hide Show
	if ($('.mobile-menu').length) {

		$('.mobile-menu .menu-box').mCustomScrollbar();

		var mobileMenuContent = $('.main-header .menu-area .main-menu').html();
		$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);
		$('.sticky-header .main-menu').append(mobileMenuContent);

		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function () {
			$(this).toggleClass('open');
			$(this).prev('ul').slideToggle(500);
		});
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function () {
			$(this).prev('.megamenu').slideToggle(900);
		});
		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function () {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function () {
			$('body').removeClass('mobile-menu-visible');
		});
	}


	// Scroll to a Specific Div
	if ($('.scroll-to-target').length) {
		$(".scroll-to-target").on('click', function () {
			var target = $(this).attr('data-target');
			// animate
			$('html, body').animate({
				scrollTop: $(target).offset().top
			}, 1000);

		});
	}

	// Elements Animation
	if ($('.wow').length) {
		var wow = new WOW({
			mobile: false
		});
		wow.init();
	}

	//Contact Form Validation
	if ($('#contact-form').length) {
		$('#contact-form').validate({
			rules: {
				username: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				phone: {
					required: true
				},
				subject: {
					required: true
				},
				message: {
					required: true
				}
			}
		});
	}

	//Fact Counter + Text Count
	if ($('.count-box').length) {
		$('.count-box').appear(function () {

			var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);

			if (!$t.hasClass("counted")) {
				$t.addClass("counted");
				$({
					countNum: $t.find(".count-text").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function () {
						$t.find(".count-text").text(Math.floor(this.countNum));
					},
					complete: function () {
						$t.find(".count-text").text(this.countNum);
					}
				});
			}

		}, { accY: 0 });
	}


	//LightBox / Fancybox
	if ($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect: 'fade',
			closeEffect: 'fade',
			helpers: {
				media: {}
			}
		});
	}


	//Tabs Box
	if ($('.tabs-box').length) {
		$('.tabs-box .tab-buttons .tab-btn').on('click', function (e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));

			if ($(target).is(':visible')) {
				return false;
			} else {
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}





	//Accordion Box
	if ($('.accordion-box').length) {
		$(".accordion-box").on('click', '.acc-btn', function () {

			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');

			if ($(this).hasClass('active') !== true) {
				$(outerBox).find('.accordion .acc-btn').removeClass('active');
			}

			if ($(this).next('.acc-content').is(':visible')) {
				return false;
			} else {
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);
			}
		});
	}


	//two-column-carousel
	if ($('.two-column-carousel').length) {
		$('.two-column-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			smartSpeed: 1000,
			autoplay: 500,
			navText: ['<span class="fas fa-algle-left"></span>', '<span class="fas fa-algle-left-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 1
				},
				600: {
					items: 1
				},
				800: {
					items: 2
				},
				1024: {
					items: 2
				}
			}
		});
	}


	//three-item-carousel
	if ($('.three-item-carousel').length) {
		$('.three-item-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			smartSpeed: 1000,
			autoplay: 500,
			navText: ['<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 1
				},
				600: {
					items: 2
				},
				800: {
					items: 2
				},
				1024: {
					items: 3
				}
			}
		});
	}


	// Five Item Carousel
	if ($('.five-item-carousel').length) {
		$('.five-item-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: ['<span class="fas fa-angle-left"></span>', '<span class="fas fa-angle-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				800: {
					items: 3
				},
				1024: {
					items: 4
				},
				1200: {
					items: 5
				}
			}
		});
	}

	// Four Item Carousel
	if ($('.four-item-carousel').length) {
		$('.four-item-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: ['<span class="fas fa-angle-left"></span>', '<span class="fas fa-angle-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				800: {
					items: 3
				},
				1024: {
					items: 4
				},
				1200: {
					items: 4
				}
			}
		});
	}


	// single-item-carousel
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop: true,
			margin: 30,
			nav: false,
			smartSpeed: 500,
			autoplay: 1000,
			navText: ['<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 1
				},
				600: {
					items: 1
				},
				800: {
					items: 1
				},
				1200: {
					items: 1
				}

			}
		});
	}




	// deals Carousel
	if ($('.deals-carousel').length) {
		$('.deals-carousel').owlCarousel({
			loop: true,
			margin: 50,
			nav: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: ['<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				800: {
					items: 1
				},
				1024: {
					items: 1
				},
				1200: {
					items: 1
				}
			}
		});
	}


	// banner-carousel
	if ($('.banner-carousel').length) {
		$('.banner-carousel').owlCarousel({
			loop: true,
			margin: 0,
			nav: true,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			active: true,
			smartSpeed: 1000,
			autoplay: 6000,
			navText: ['<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				800: {
					items: 1
				},
				1024: {
					items: 1
				}
			}
		});
	}


	//Add One Page nav
	if ($('.scroll-nav').length) {
		$('.scroll-nav').onePageNav();
	}

	//Sortable Masonary with Filters
	function enableMasonry() {
		if ($('.sortable-masonry').length) {

			var winDow = $(window);
			// Needed variables
			var $container = $('.sortable-masonry .items-container');
			var $filter = $('.filter-btns');

			$container.isotope({
				filter: '*',
				masonry: {
					columnWidth: '.masonry-item.small-column'
				},
				animationOptions: {
					duration: 500,
					easing: 'linear'
				}
			});


			// Isotope Filter 
			$filter.find('li').on('click', function () {
				var selector = $(this).attr('data-filter');

				try {
					$container.isotope({
						filter: selector,
						animationOptions: {
							duration: 500,
							easing: 'linear',
							queue: false
						}
					});
				} catch (err) {

				}
				return false;
			});


			winDow.on('resize', function () {
				var selector = $filter.find('li.active').attr('data-filter');

				$container.isotope({
					filter: selector,
					animationOptions: {
						duration: 500,
						easing: 'linear',
						queue: false
					}
				});
			});


			var filterItemA = $('.filter-btns li');

			filterItemA.on('click', function () {
				var $this = $(this);
				if (!$this.hasClass('active')) {
					filterItemA.removeClass('active');
					$this.addClass('active');
				}
			});
		}
	}

	enableMasonry();


	//Price Range Slider
	if ($('.price-range-slider').length) {
		$(".price-range-slider").slider({
			range: true,
			min: 0,
			max: 10000,
			values: [1000, 5000],
			slide: function (event, ui) {
				$("input.property-amount").val(ui.values[0] + " - " + ui.values[1]);
			}
		});

		$("input.property-amount").val($(".price-range-slider").slider("values", 0) + " - $" + $(".price-range-slider").slider("values", 1));
	}

	//Area Range Slider
	if ($('.area-range-slider').length) {
		$(".area-range-slider").slider({
			range: true,
			min: 0,
			max: 7000,
			values: [700, 4000],
			slide: function (event, ui) {
				$("input.area-range").val(ui.values[0] + " - " + ui.values[1]);
			}
		});

		$("input.area-range").val($(".area-range-slider").slider("values", 0) + " - sq ft" + $(".area-range-slider").slider("values", 1));
	}


	// Progress Bar
	if ($('.count-bar').length) {
		$('.count-bar').appear(function () {
			var el = $(this);
			var percent = el.data('percent');
			$(el).css('width', percent).addClass('counted');
		}, { accY: -50 });

	}


	$(document).ready(function () {
		$('select:not(.ignore)').niceSelect();
	});


	// color switcher
	function swithcerMenu() {
		if ($('.switch_menu').length) {

			$('.switch_btn button').on('click', function () {
				$('.switch_menu').toggle(500)
			});

			$('#styleOptions').styleSwitcher({
				hasPreview: true,
				fullPath: 'assets/css/color/',
				cookie: {
					expires: 30,
					isManagingLoad: true
				}
			});

		};
	}


	// page direction
	function directionswitch() {
		if ($('.page_direction').length) {

			$('.direction_switch button').on('click', function () {
				$('body').toggleClass(function () {
					return $(this).is('.rtl, .ltr') ? 'rtl ltr' : 'rtl';
				})
			});
		};
	}


	if ($('.paroller').length) {
		$('.paroller').paroller({
			factor: 0.1,            // multiplier for scrolling speed and offset, +- values for direction control  
			factorLg: 0.1,          // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control  
			type: 'foreground',     // background, foreground  
			direction: 'vertical' // vertical, horizontal  
		});
	}

	if ($('.paroller-2').length) {
		$('.paroller-2').paroller({
			factor: -0.1,            // multiplier for scrolling speed and offset, +- values for direction control  
			factorLg: -0.1,          // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control  
			type: 'foreground',     // background, foreground  
			direction: 'vertical' // vertical, horizontal  
		});
	}

	// Date picker
	function datepicker() {
		if ($('#datepicker').length) {
			$('#datepicker').datepicker();
		};
	}



	// Time picker
	function timepicker() {
		if ($('input[name="time"]').length) {
			$('input[name="time"]').ptTimeSelect();
		}
	}


	if ($('.property-details .bxslider').length) {
		$('.property-details .bxslider').bxSlider({
			auto: true,
			nextSelector: '.property-details #slider-next',
			prevSelector: '.property-details #slider-prev',
			nextText: '<i class="fa fa-angle-right"></i>',
			prevText: '<i class="fa fa-angle-left"></i>',
			mode: 'fade',
			auto: 'true',
			speed: '700',
			pagerCustom: '.property-details .slider-pager .thumb-box'
		});
	};


	/*	=========================================================================
	When document is Scrollig, do
	========================================================================== */

	jQuery(document).on('ready', function () {
		(function ($) {
			// add your functions
			directionswitch();
			swithcerMenu();
			datepicker();
			timepicker();
		})(jQuery);
	});



	/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

	$(window).on('scroll', function () {
		headerStyle();
	});

	//numbers only
	$('.numbers').keypress(function (e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
	});


	/* ==========================================================================
   When document is loaded, do
   ========================================================================== */

	$(window).on('load', function () {
		handlePreloader();
		enableMasonry();
	});

	// Signout
	$('.btn-signout').on('click', function (e) {
		e.preventDefault();
		const href = $(this).attr('href')

		swal({
			title: "Signout?",
			text: "Are you sure do you want to signout?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
			.then((willSignout) => {
				if (willSignout) {
					document.location.href = href;
				}
			});
	})



})(window.jQuery);

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
	'use strict'

	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	const forms = document.querySelectorAll('.needs-validation')

	// Loop over them and prevent submission
	Array.from(forms).forEach(form => {
		form.addEventListener('submit', event => {

			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()

				swal({
					title: "Oops!",
					text: "Please fill in all required fields!",
					icon: "error",
					button: false,
					timer: 10000,
				});
			}

			form.classList.add('was-validated')
		}, false)
	})
})()

//IMAGE PREVEIW FOR PROPERTY REGISTRATION
function previewImage(event, containerId, previewId) {
	var input = event.target;
	var preview = document.getElementById(previewId);
	var container = document.getElementById(containerId);

	// Ensure that a file was selected
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			// Update the source of the image and show the preview container
			preview.src = e.target.result;
			container.style.display = 'block';
		};

		reader.readAsDataURL(input.files[0]); // Read the selected file as a data URL
	} else {
		// If no file is selected, hide the preview container
		container.style.display = 'none';
	}
}

function closePreview(containerId, inputId) {
    var container = document.getElementById(containerId);
    var preview = container.querySelector('img');
    var input = document.getElementById(inputId);

    // Hide the preview container
    container.style.display = 'none';

    // Clear the image source to hide the preview
    preview.src = '';

    // Reset the file input element
    input.value = '';
}



//FOR AMENITIES AND DAYS PROPERTY REGISTRATION
function submitForm() {
	// Get the form element
	var form = document.getElementById('propertyForm');

	// Create an array to store selected amenities
	var selectedAmenities = [];
	var amenitiesCheckboxes = form.querySelectorAll('input[name="amenities[]"]:checked');
	amenitiesCheckboxes.forEach(function (checkbox) {
		selectedAmenities.push(checkbox.value);
	});

	// Create an array to store selected days
	var selectedDays = [];
	var daysCheckboxes = form.querySelectorAll('input[name="days[]"]:checked');
	daysCheckboxes.forEach(function (checkbox) {
		selectedDays.push(checkbox.value);
	});

	// Convert the arrays to strings (you can adjust the format as needed)
	var amenitiesString = selectedAmenities.join(', ');
	var daysString = selectedDays.join(', ');

	// Create hidden inputs to store the selected values
	var amenitiesInput = document.createElement('input');
	amenitiesInput.type = 'hidden';
	amenitiesInput.name = 'selected_amenities';
	amenitiesInput.value = amenitiesString;

	var daysInput = document.createElement('input');
	daysInput.type = 'hidden';
	daysInput.name = 'selected_days';
	daysInput.value = daysString;

	// Append the hidden inputs to the form
	form.appendChild(amenitiesInput);
	form.appendChild(daysInput);
}

//see more
function toggleDescription() {
    var description = document.getElementById('propertyDescription');
    var link = document.querySelector('a');

    if (description.style.maxHeight) {
      description.style.maxHeight = null;
      link.innerHTML = 'See more';
    } else {
      description.style.maxHeight = description.scrollHeight + 'px';
      link.innerHTML = 'See less';
    }
  }


//birthdate
function formatDate(date) {
	var d = new Date(date),
		month = '' + (d.getMonth() + 1),
		day = '' + d.getDate(),
		year = d.getFullYear();

	if (month.length < 2) month = '0' + month;
	if (day.length < 2) day = '0' + day;

	return [year, month, day].join('-');

}

function getAge(dateString) {
	var birthdate = new Date().getTime();
	if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')) {
		birthdate = new Date().getTime();
	}
	birthdate = new Date(dateString).getTime();
	var now = new Date().getTime();
	var n = (now - birthdate) / 1000;
	if (n < 604800) {
		var day_n = Math.floor(n / 86400);
		if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')) {
			return '';
		} else {
			return day_n + '' + (day_n > 1 ? '' : '') + '';
		}
	} else if (n < 2629743) {
		var week_n = Math.floor(n / 604800);
		if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')) {
			return '';
		} else {
			return week_n + '' + (week_n > 1 ? '' : '') + '';
		}
	} else if (n < 31562417) {
		var month_n = Math.floor(n / 2629743);
		if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')) {
			return '';
		} else {
			return month_n + ' ' + (month_n > 1 ? '' : '') + '';
		}
	} else {
		var year_n = Math.floor(n / 31556926);
		if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')) {
			return year_n = '';
		} else {
			return year_n + '' + (year_n > 1 ? '' : '') + '';
		}
	}
}
function getAgeVal(pid) {
	var birthdate = formatDate(document.getElementById("date_of_birth").value);
	var count = document.getElementById("date_of_birth").value.length;
	if (count == '10') {
		var age = getAge(birthdate);
		var str = age;
		var res = str.substring(0, 1);
		if (res == '-' || res == '0') {
			document.getElementById("date_of_birth").value = "";
			document.getElementById("age").value = "";
			$('#date_of_birth').focus();
			return false;
		} else {
			document.getElementById("age").value = age;
		}
	} else {
		document.getElementById("age").value = "";
		return false;
	}
};


//Delete Profile
$('.delete_property').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href')

	swal({
		title: "Delete?",
		text: "Do you want to delete this property?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				document.location.href = href;
			}
		});
})