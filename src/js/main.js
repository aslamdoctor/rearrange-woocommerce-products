//import Sortable from "sortablejs";
import { Sortable, MultiDrag } from "sortablejs";
Sortable.mount(new MultiDrag());

(function ($) {
  // On Dom Ready
  $(function () {
    // Make products list sortable
    var list_element = document.getElementById("rwpp-products-list");

    var sortable = Sortable.create(list_element, {
      animation: 150,
      ghostClass: "ghost",
      multiDrag: true, // Enable the plugin
      selectedClass: "sortable-selected", // Class name for selected item
      onSort: reportActivity,
    });

    // Get sort orders and submit to save
    $("#rwpp-get-orders").on("click", function () {
      var submitButton = $(this);
      var buttonText = submitButton.text();
      if (confirm("Are you sure you want to make these changes?")) {
        submitButton.attr("disabled", "true");
        submitButton.text("Processing...");
        var sort_orders = sortable.toArray();
        var saveData = {};
        saveData.action = "save_all_order";
        saveData.sort_orders = sort_orders;

        $.ajax({
          type: "POST",
          url: ajaxurl,
          data: saveData,
          success: function (response) {
            console.log(response);
            $("#rwpp-response").html(response);
          },
          error: function (error) {
            console.log("Error:", error);
          },
          complete: function () {
            submitButton.removeAttr("disabled");
            submitButton.text(buttonText);
          },
        });
      }
    });

    // Move item to Top
    $("span.rwpp-product-movement .move-top").on("click", function (e) {
      e.preventDefault;
      var this_item = $(this).closest(".rwpp-product");
      this_item.prependTo(list_element);
      rwpp_remove_selected(this_item);
    });

    // Move item to Bottom
    $("span.rwpp-product-movement .move-bottom").on("click", function (e) {
      e.preventDefault;
      var this_item = $(this).closest(".rwpp-product");
      this_item.appendTo(list_element);
      rwpp_remove_selected(this_item);
    });

    // Move item Up
    $("span.rwpp-product-movement .move-up").on("click", function (e) {
      e.preventDefault;
      var this_item = $(this).closest(".rwpp-product");
      this_item.prev().insertAfter(this_item);
      rwpp_remove_selected(this_item);
    });

    // Move item Down
    $("span.rwpp-product-movement .move-down").on("click", function (e) {
      e.preventDefault;
      var this_item = $(this).closest(".rwpp-product");
      this_item.next().insertBefore(this_item);
      rwpp_remove_selected(this_item);
    });

    // View product info
    $("span.rwpp-product-movement .view-product-info").on("click", function (e) {
      e.preventDefault;
      var this_item = $(this).closest(".rwpp-product");
      this_item.find(".rwpp-product-info").toggleClass("active");
      rwpp_remove_selected(this_item);
    });

    function rwpp_remove_selected(ele) {
      ele.removeClass("sortable-selected");
      ele.removeAttr("draggable");
    }
  });

  // Report when the sort order has changed
  function reportActivity() {
    console.log("The sort order has changed");
  }
})(jQuery);
