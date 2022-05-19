jQuery(document).ready(function ($) {
	var masnoryContainer = $(".grid-parent-gosign");
	masnoryContainer.each(function() {
		var layout = $(this).attr("data-layout");
		var $grid = $(this).imagesLoaded(function() {
			$gutter = parseInt($grid.attr("data-gutter"));
				$grid.isotope({
				// options
				itemSelector: ".grid-item",
				horizontalOrder: true,
				layoutMode: layout,
				transitionDuration: "0.6s",
				percentPosition: true,
				masonry: {
				// use element for option
					columnWidth: ".grid-sizer",
					gutter: $gutter
				},
				fitRows: {
				// use element for option
					columnWidth: ".grid-sizer",
					gutter: $gutter
				},
				vertical: {
				// use element for option
					columnWidth: ".grid-sizer",
					gutter: $gutter
				},
				filter: "*"
			});
			$grid.find(".grid-item").toggleClass("animate");
		});

		$(this)
		.parent()
		.find(".gosign_categories_filters")
		.on("click", "a", function(e) {
			e.preventDefault();
			$(this)
			.parent()
			.find(".gosign_filter")
			.removeClass("active");
			$(this).addClass("active");
			var filterValue = $(this).attr("data-filter");
			$grid.isotope({ filter: filterValue });
		});

		var lazyThreshold = ($(this).attr("data-lazyThreshold") ? lazyThreshold : 0);
		// Lazy loading
		$('.masnory-image').Lazy({
			effect: 'fadeIn',
			effectTime: 200,
			visibleOnly: true,
			threshold: lazyThreshold,
			onError: function(element) {
				console.log('error loading ' + element.data('src'));
			},
			afterLoad: function(element) {
				// called after an element was successfully handled
				$grid.isotope('layout');
				element.removeClass('masLazy');
			}
		});
	});
});

