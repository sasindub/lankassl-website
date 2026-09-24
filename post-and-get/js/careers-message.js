$(document).ready(function () {
  $("#send-cr-email").click(function (event) {
    event.preventDefault();
    //if (!validateRecaptcha()) {
    // return false(); // Prevent form submission
//  } else {
    if (!$("#name").val() || $("#name").val().length === 0) {
      Swal.fire({
        title: "Error!",
        text: "Please enter name..!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return false;
    
    } else if (!$("#email").val() || $("#email").val().length === 0) {
      Swal.fire({
        title: "Error!",
        text: "Please enter email..!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#phone").val() ||
      $("#phone").val().length === 0
    ) {
      Swal.fire({
        title: "Error!",
        text: "Please enter contact number..!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return false;
     } else if (!$("#position").val() || $("#position").val().length === 0) {
       Swal.fire({
        title: "Error!",
         text: "Please enter position..!",
         icon: "error",
         timer: 1500,
         showConfirmButton: false,
       });

       return false;
      } else if (!$("#pdf").val() || $("#pdf").val().length === 0) {
        Swal.fire({
         title: "Error!",
          text: "Please enter cv..!",
          icon: "error",
          timer: 1500,
          showConfirmButton: false,
        });

      return false;
    
    } else if (!$("#message").val() || $("#message").val().length === 0) {
      Swal.fire({
        title: "Error!",
        text: "Please enter message..!",
        icon: "error",
        timer: 1500,
        showConfirmButton: false,
      });
      return false;
    } else {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to send this enquiry?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "danger",
        confirmButtonText: "Yes, send it",
        closeOnConfirm: false,
      }).then((result) => {
        if (result.isConfirmed) {
          window.Swal.fire({
            title: "Please wait...",
            text: "Please wait for your request to be processed..!",
            imageUrl: "assets/img/loading.gif",
            showConfirmButton: false,
            allowOutsideClick: false,
          });

          var formData = new FormData($("#contactForm")[0]);
          $.ajax({
            url: "post-and-get/ajax/careers-message.php",
            type: "POST",
            data: formData,
            async: true,
            dataType: "json",
            success: function (result) {
              if (result.status == "error") {
                Swal.fire({
                  title: "Error!",
                  text: result.message,
                  icon: "error",
                  timer: 2000,
                  showConfirmButton: false,
                });
              } else {
                Swal.fire({
                  title: "Success!",
                  text: "Your enquiry has been sent successfully!...",
                  icon: "success",
                  timer: 2000,
                  showConfirmButton: false,
                }).then((result) => {
                  setTimeout(function () {
                    window.location.replace("https://lankassl.onespencer.co.uk/careers");
                  }, 2000);
                });
              }
            },
            cache: false,
            contentType: false,
            processData: false,
          });
        }
      });
    }
 // }
  });
  function validateRecaptcha() {
    var response = grecaptcha.getResponse();

    if (response.length === 0) {
        // reCAPTCHA not verified
        Swal.fire({
          title: "Error!",
          text: "Please complete the reCAPTCHA challenge...!",
          icon: "error",
          timer: 1500,
          showConfirmButton: false,
        });
        return false; // Prevent form submission
    } else {
        // reCAPTCHA verified
        return true; // Proceed with form submission
    }
}

});
