$(".sub-menu").addClass('dropdown-menu');
$(document).ready(function () {

    // woocommerce after add to cart custom minicart update
    $('body').on('added_to_cart', function (event, fragments, cart_hash) {
        var ajxData = {
            action: 'bq_update_mini_cart'
        };

        $.post(bqFront.ajaxurl, ajxData, function (response) {
            obj = JSON.parse(response);
            $("#headerMiniCarttotalItem").text(obj.total_item);
            $("#headerMiniCartItemList").html(obj.item_list_html);
            $("#headerMiniCarttotalCost").html(obj.total_cost);
        });
    });

    $('body').on('updated_cart_totals', function () {
        //alert("tttt");
        var ajxData = {
            action: 'bq_update_mini_cart'
        };

        $.post(bqFront.ajaxurl, ajxData, function (response) {
            obj = JSON.parse(response);
            $("#headerMiniCarttotalItem").text(obj.total_item);
            $("#headerMiniCartItemList").html(obj.item_list_html);
            $("#headerMiniCarttotalCost").html(obj.total_cost);
        });
    });

    $("form.cart").on('change', 'input#singleProductQty', function () {
        var productQty = $(this).val();
        $("#singleProductAddToCartBtn").data("quantity", productQty);
        //$("#singleProductAddToCartBtn").attr("data-quantity", productQty);
    });

    var projects = new Array();
    var productSearchURL = 'http://localhost/aupranon/search-data/';

    $(".loading").show();
    $.ajax({
        url: productSearchURL,
        type: 'POST',
        data: {catType : 'book' },
    }).success(function (data) {
        var countryData = $.parseJSON(data);
        $.each(countryData, function(index, val) {
          projects.push(val);
        });
        $(".loading").hide();
    });

    $("#project").attr("placeholder", "Search by book");

    $( "#project" ).autocomplete({
      source: projects
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( '<a href="'+item.url+'"><table class="table"><tr><td style="width: 100px;"><img src="'+item.image+'" class="media-object" style="width:80px; height:100px;"></td><td class="text-left"><h4 class="media-heading">' + item.title + '</h4><p>'+ item.writer+'</p></td><td class="text-right"><h5>'+item.salePrice+'<br/><span class="text-danger">'+item.regularpPrice+'</span></h5></div></td></tr></table></a></div>' )
        .appendTo( ul );
    };

    $("#selectSearch a").click(function () {
      $(".loading").show();
      var projects = new Array();
      var value = $(this).attr("data");
      var name = $(this).attr("name");
      if(value == 'book'){
        $("#project").attr("placeholder", "Search by book");
      }
      if(value == 'publisher'){
        $("#project").attr("placeholder", "Search by publisher");
      }
      if(value == 'writer'){
        $("#project").attr("placeholder", "Search by writer");
      }
      if(value == 'product_cat'){
        $("#project").attr("placeholder", "Search by category");
      }
      var buttonText = name +' <span class="caret"></span>';
      $(".dropdown-toggle-custom").html(buttonText);

      $.ajax({
          url: productSearchURL,
          type: 'POST',
          data: {catType : value },
      }).success(function (data) {
          var countryData = $.parseJSON(data);
          $.each(countryData, function(index, val) {
            projects.push(val);
          });
          $(".loading").hide();
      });
      $( "#project" ).autocomplete({
        source: projects
      }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
          .append( '<a href="'+item.url+'"><table class="table"><tr><td style="width: 100px;"><img src="'+item.image+'" class="media-object" style="width:80px; height:100px;"></td><td class="text-left"><h4 class="media-heading">' + item.title + '</h4><p>'+ item.writer+'</p></td><td class="text-right"><h5>'+item.salePrice+'<br/><span class="text-danger">'+item.regularpPrice+'</span></h5></div></td></tr></table></a></div>' )
          .appendTo( ul );
      };
    });

});
