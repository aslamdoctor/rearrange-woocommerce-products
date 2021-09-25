import Sortable from "sortablejs";

(function ($) {
  // On Dom Ready
  $(function () {
    console.log("Dom loaded...");
    // Make products list sortable
    var list_element = document.getElementById("rwpp-products-list");

    var sortable = Sortable.create(list_element, {
      animation: 150,
      ghostClass: "ghost",
      onSort: reportActivity,
    });

    // Get sort orders and submit to save
    $("#rwpp-get-orders").on("click", function () {
      if (confirm("Are you sure you want to make these changes?")) {
        var order = sortable.toArray();
        console.log(order);
      }
    });

    // Move item to Top
    $("span.rwpp-product-movement .move-top").on("click", function (e) {
      var this_item = $(this).closest(".rwpp-product");
      this_item.prependTo(list_element);
    });

    // Move item to Bottom
    $("span.rwpp-product-movement .move-bottom").on("click", function (e) {
      var this_item = $(this).closest(".rwpp-product");
      this_item.appendTo(list_element);
    });

    // Move item Up
    $("span.rwpp-product-movement .move-up").on("click", function (e) {
      var this_item = $(this).closest(".rwpp-product");
      this_item.prev().insertAfter(this_item);
    });

    // Move item Down
    $("span.rwpp-product-movement .move-down").on("click", function (e) {
      var this_item = $(this).closest(".rwpp-product");
      this_item.next().insertBefore(this_item);
    });

    // View product info
    $("span.rwpp-product-movement .view-product-info").on("click", function (e) {
      var this_item = $(this).closest(".rwpp-product");
      this_item.find(".rwpp-product-info").toggleClass("active");
    });
  });

  // Report when the sort order has changed
  function reportActivity() {
    console.log("The sort order has changed");
  }
})(jQuery);
