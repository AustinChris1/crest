const reviewForm = document.querySelector(".reviewForm"),
  reviewBtn = document.querySelector("#save_review");
var rating_data = 0;

reviewForm.onsubmit = (e) => {
  e.preventDefault();
};

$(document).ready(function () {
   var user_id = $("#user_id").val();
   var product_id = $("#product_id").val();
setInterval(load_rating_data,5000);

  // load_rating_data();
  $(document).on("mouseenter", ".submit_star", function () {
    var rating = $(this).data("rating");

    reset_background();

    for (var count = 1; count <= rating; count++) {
      $("#submit_star_" + count).addClass("text-warning");
    }
  });

  function reset_background() {
    for (var count = 1; count <= 5; count++) {
      $("#submit_star_" + count).addClass("star-light");

      $("#submit_star_" + count).removeClass("text-warning");
    }
  }

  $(document).on("mouseleave", ".submit_star", function () {
    reset_background();

    for (var count = 1; count <= rating_data; count++) {
      $("#submit_star_" + count).removeClass("star-light");

      $("#submit_star_" + count).addClass("text-warning");
    }
  });
  $(document).on("click", ".submit_star", function () {
    rating_data = $(this).data("rating");
  });

  $("#save_review").click(function () {
    var name = $("#name").val();
    var email = $("#email").val();

    var review = $("#message").val();
if(user_id == ''){
  swal({
    title: "Error!",
    text: "Please login!",
    icon: "error",
    // buttons: true,
    dangerMode: false,
  });
}else{

    if (name == "" || review == "" || email == "") {
      alert("Please Fill Both Field");
      return false;
    } else {
      $.ajax({
        url: "/crest/php/review.php",
        method: "POST",
        data: {
          rating_data: rating_data,
          name: name,
          email: email,
          review: review,
          user_id: user_id,
          product_id: product_id,
        },
        success: function (data) {
          load_rating_data();
          reviewForm.reset();
          if (data == "success") {
            swal({
              title: "Success",
              text: "Your review has been submitted!",
              icon: "success",
              // buttons: true,
              dangerMode: false,
            });
          } else {
            swal({
              title: "Error!",
              text: data,
              icon: "error",
              // buttons: true,
              dangerMode: false,
            });
          }
        },
      });
    }
 }
   
  });

  function load_rating_data() {
    $.ajax({
      url: "/crest/php/review.php",
      method: "POST",
      data: { action: "load_data",user_id: user_id, product_id: product_id, },
      dataType: "JSON",
      success: function (data) {
        $("#average_rating").text(data.average_rating);
        $("#total_review").text(data.total_review);

        var count_star = 0;

        $(".main_star").each(function () {
          count_star++;
          if (Math.ceil(data.average_rating) >= count_star) {
            $(this).addClass("text-warning");
            $(this).addClass("star-light");
          }
        });

        $("#total_five_star_review").text(data.five_star_review);

        $("#total_four_star_review").text(data.four_star_review);

        $("#total_three_star_review").text(data.three_star_review);

        $("#total_two_star_review").text(data.two_star_review);

        $("#total_one_star_review").text(data.one_star_review);

        $("#five_star_progress").css(
          "width",
          (data.five_star_review / data.total_review) * 100 + "%"
        );

        $("#four_star_progress").css(
          "width",
          (data.four_star_review / data.total_review) * 100 + "%"
        );

        $("#three_star_progress").css(
          "width",
          (data.three_star_review / data.total_review) * 100 + "%"
        );

        $("#two_star_progress").css(
          "width",
          (data.two_star_review / data.total_review) * 100 + "%"
        );

        $("#one_star_progress").css(
          "width",
          (data.one_star_review / data.total_review) * 100 + "%"
        );

        if (data.review_data.length > 0) {
          var html = "";

          for (var count = 0; count < data.review_data.length; count++) {
            
            html += '<div class="col-sm-11 mb-3">';

            html += '<div class="card">';

            html +=
              '<div class="card-header"><b>' +
              data.review_data[count].name +
              "</b></div>";

            html += '<div class="card-body">';

            for (var star = 1; star <= 5; star++) {
              var class_name = "";

              if (data.review_data[count].rating >= star) {
                class_name = "text-warning";
              } else {
                class_name = "star-light";
              }

              html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
            }

            html += "<br />";

            html += data.review_data[count].review;

            html += "</div>";

            html +=
              '<div class="card-footer text-right">On ' +
              data.review_data[count].datetime +
              "</div>";

            html += "</div>";

            html += "</div>";

            html += "</div>";
          }

          $("#review_content").html(html);
        }
      },
    });
  }
});
