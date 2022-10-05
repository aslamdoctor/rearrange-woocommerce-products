import { Sortable, MultiDrag } from "sortablejs";
Sortable.mount(new MultiDrag());

(function ($) {
  // On Dom Ready
  $(function () {
    // Sort by All Products
    var list_element = document.getElementById("rwpp-products-list");
    if (list_element) {
      var sortable = Sortable.create(list_element, {
        animation: 150,
        ghostClass: "ghost",
        multiDrag: true, // Enable the plugin
        selectedClass: "sortable-selected", // Class name for selected item
        //onSort: reportActivity,
      });

      // Get sort orders and submit to save
      $("#rwpp-save-orders").on("click", function () {
        var submitButton = $(this);
        var buttonText = submitButton.text();
        if (confirm("Are you sure you want to make these changes?")) {
          submitButton.attr("disabled", "true");
          submitButton.text("Processing...");
          var sort_orders = sortable.toArray();
          var saveData = {};
          saveData.sort_orders = sort_orders;

          saveData.action = "save_all_order";
          if ($("#rwpp_product_category").length) {
            saveData.term_id = $("#rwpp_product_category").val();
            saveData.action = "save_all_order_by_category";
          }
          saveData.nonce = rwpp_ajax_var.nonce;

          $.ajax({
            type: "POST",
            url: rwpp_ajax_var.url,
            data: saveData,
            success: function (response) {
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

      // Order by price
      $("#rwpp-sort-by-price").on("click", function () {
        var submitButton = $(this);
        console.log(submitButton);
        var buttonText = submitButton.text();
        submitButton.attr("disabled", "true");
        submitButton.text("Processing...");

        sortable.sort(SortData(), true);

        function comparator(a, b) {
          if (parseFloat(a.dataset.price) < parseFloat(b.dataset.price))
            return -1;
          if (parseFloat(a.dataset.price) > parseFloat(b.dataset.price))
            return 1;
          return 0;
        }

        async function SortData() {
          var subjects =
            document.querySelectorAll("[data-price]");
          var subjectsArray = Array.from(subjects);
          let sorted = subjectsArray.sort(comparator);

          submitButton.removeAttr("disabled");
          submitButton.text(buttonText);

          return sorted.map(x => x.dataset.id);
        }
      });

      $("#rwpp-upgrades-bottom").on("click", function () {
        var submitButton = $(this);
        var buttonText = submitButton.text();
        submitButton.attr("disabled", "true");
        submitButton.text("Processing...");

        sortable.sort(MoveData(), true);

        submitButton.removeAttr("disabled");
        submitButton.text(buttonText);

        function MoveData() {
          var subjects =
            document.querySelectorAll("[data-upgrade]");
          var subjectsArray = Array.from(subjects);
          var upgrade = [];
          subjectsArray.forEach(function (item) {
            if (item.dataset.upgrade === "true") {
              subjectsArray.splice(subjectsArray.indexOf(item), 1);
              upgrade.push(item);
            }
          });
          var sorted = subjectsArray.concat(upgrade);
          return sorted.map(x => x.dataset.id);
        }
      });

      $("#rwpp-best-top").on("click", function () {
        var submitButton = $(this);
        var buttonText = submitButton.text();
        submitButton.attr("disabled", "true");
        submitButton.text("Processing...");

        sortable.sort(MoveData(), true);

        submitButton.removeAttr("disabled");
        submitButton.text(buttonText);

        function MoveData() {
          var subjects =
            document.querySelectorAll("[data-bestseller]");
          var subjectsArray = Array.from(subjects);
          var bestseller = [];
          subjectsArray.forEach(function (item) {
            if (item.dataset.bestseller === "true") {
              subjectsArray.splice(subjectsArray.indexOf(item), 1);
              bestseller.push(item);
            }
          });
          var sorted = bestseller.concat(subjectsArray);
          return sorted.map(x => x.dataset.id);
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
    }

    // Sort by Category
    $("#rwpp_product_category").on("change", function (e) {
      var category_id = $(this).val();
      var current_page_url = $("#rwpp_current_page_url").val();
      if (category_id !== "") {
        current_page_url = updateQueryStringParameter(current_page_url, "term_id", category_id);
      } else {
        current_page_url = updateQueryStringParameter(current_page_url, "term_id", 0);
      }
      window.location.href = current_page_url;
    });
  });

  // Report when the sort order has changed
  function reportActivity() {
    console.log("The sort order has changed");
  }

  function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf("?") !== -1 ? "&" : "?";
    if (uri.match(re)) {
      return uri.replace(re, "$1" + key + "=" + value + "$2");
    } else {
      return uri + separator + key + "=" + value;
    }
  }
})(jQuery);