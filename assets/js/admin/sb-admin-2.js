(function ($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict
var i = 0;
function addListItem() {
  event.preventDefault();
  // Get the values from the input fields


  // Create a new list item with the input values
  const listItem = document.createElement("li");
  listItem.classList.add("list-group-item");
  listItem.innerHTML = `
      <div class="form-row align-items-center">
          <div class="col-md-6">
              <label class="sr-only" for="value${i}"></label>
              <input type="text" class="form-control mb-2 mr-sm-2" id="value${i}" name="title[]" placeholder="Value" value="">
          </div>
          <div class="col-md-6">
              <label class="sr-only" for="value1_${i}"></label>
              <input type="text" class="form-control mb-2 mr-sm-2" id="value1_${i}" name="content[]" placeholder="Value" value="">
          </div>
      </div>
  `;
  i++;
  // Append the new list item to the ul
  const ul = document.getElementById("sortable");
  ul.appendChild(listItem);
}
var j = 0;
function addListItemMoTaProdDetail() {
  event.preventDefault();
  // Get the values from the input fields


  // Create a new list item with the input values
  const listItem = document.createElement("li");
  listItem.classList.add("list-group-item");
  listItem.innerHTML = `
  <div class="form-row align-items-start">
    <div class="col-md-12">
      <label class="sr-only" for="valueTitle${j}">Title</label>
      <input type="text" class="form-control mb-2 mr-sm-2" id="valueTitle${j}" name="InsertMoTaTitle[]" placeholder="Title" value="">
    </div>
    <div class="col-md-12">
      <label class="sr-only" for="valueImg${j}">Image</label>
      <input type="file" class="form-control-file mb-2 mr-sm-2" id="valueImg${j}" name="InsertMoTaImg[]">
    </div>
    <div class="col-md-12">
      <label class="sr-only" for="valueContent${j}">Content</label>
      <textarea class="form-control mb-2 mr-sm-2" id="valueContent${j}" name="InsertMoTaContent[]" placeholder="Content"></textarea>
    </div>
  </div>
  `;
  j++;
  // Append the new list item to the ul
  const ul = document.getElementById("sortable1");
  ul.appendChild(listItem);
}

// Get the input field and attach an event listener
var inputField = document.getElementById('inputSearch');
inputField.addEventListener('input', searchTable);

// Function to search the table
function searchTable() {
  var searchText = inputField.value.toLowerCase(); // Convert search text to lowercase for case-insensitive search
  var table = document.getElementById('dataTable');
  var rows = table.getElementsByTagName('tr');

  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName('td');
    var found = false;

    for (var j = 0; j < cells.length; j++) {
      var cellText = cells[j].textContent.toLowerCase();

      if (cellText.indexOf(searchText) > -1) {
        found = true;
        break;
      }
    }

    // Show/hide rows based on search result
    if (searchText === '' || found) {
      rows[i].style.display = '';
    } else {
      rows[i].style.display = 'none';
    }
  }
}


