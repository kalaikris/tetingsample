function imageUpload(file_id, img_src, valid, uploadtext, hideDiv, hideErrortext) {
  var fileUpload = document.getElementById(file_id);
  var files = !!fileUpload.files ? fileUpload.files : [];
  var regex = new RegExp("([a-zA-Z0-9s_\\.-:])+(.jpg|.png|.gif|.jpeg|.pdf)$");
  if (regex.test(files[0].type)) {
    if (typeof fileUpload.files != "undefined") {
      var reader = new FileReader();
      reader.readAsDataURL(fileUpload.files[0]);
      reader.onload = function (e) {
        var image = new Image();
        image.src = e.target.result;
        image.onload = function () {
          $("#" + img_src).attr("src", image.src);
          //$('#' + valid).val("true");
        };
      };
    }
    var file = fileUpload.files[0];
    var file_id = file_id;
    if (file_id == "userImage" && file_id == "companyImage") {
      var folder = "service_provider_company/company_logo/";
    } else {
      var folder = "service_provider_company/documents/";
    }
    s3_file_image(file,valid,uploadtext,hideDiv,file_id,folder,hideErrortext);
  }
}

function s3_file_image(file,valid,uploadtext,hideDiv,file_id,folder,hideErrortext) {
  waitingDialog.show("Image is Uploading", {
    dialogSize: "sm",
    progressType: "warning",
  });
  var seconds = new Date().getTime();
  seconds = parseInt(seconds);
  var extension = file.name.split(".").pop().toLowerCase();
  var filename = seconds + "." + extension;
  var image_fileurl = aws_cloudfront_url + folder + filename;
  var objKey = folder + filename;
  var params = {
    Key: objKey,
    ContentType: file.type,
    Body: file,
  };
  bucket.putObject(params, function (err, data) {
    if (err) {
      alert("ERROR: " + err);
    } else if (file_id == "userImage") {
      $("#companylogourl").val(image_fileurl);
    } else if (file_id == "companyImage") {
      $("#companyimageurl").val(image_fileurl);
    } else {
      $("#" + valid).val(image_fileurl);
      $("." + uploadtext).css("display", "block");
      $("." + hideDiv).hide();
      $("#" + hideErrortext).text("");
    }
    setTimeout(() => waitingDialog.hide(), 500);
  });
}

var waitingDialog =
  waitingDialog ||
  (function ($) {
    "use strict";
    // Creating modal dialogs DOM
    var $dialog = $(
      '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
      '<div class="modal-dialog modal-m">' +
      '<div class="modal-content">' +
      '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
      '<div class="modal-body">' +
      '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
      "</div>" +
      "</div></div></div>"
    );
    return {
      show: function (message, options) {
        // Assigning defaults
        if (typeof options === "undefined") {
          options = {};
        }
        if (typeof message === "undefined") {
          message = "Loading";
        }
        var settings = $.extend(
          {
            dialogSize: "m",
            progressType: "",
            onHide: null, // This callback runs after the dialog was hidden
          },
          options
        );
        // Configuring dialog
        $dialog
          .find(".modal-dialog")
          .attr("class", "modal-dialog")
          .addClass("modal-" + settings.dialogSize);
        $dialog.find(".progress-bar").attr("class", "progress-bar");
        if (settings.progressType) {
          $dialog
            .find(".progress-bar")
            .addClass("progress-bar-" + settings.progressType);
        }
        $dialog.find("h3").text(message);
        // Adding callbacks
        if (typeof settings.onHide === "function") {
          $dialog.off("hidden.bs.modal").on("hidden.bs.modal", function (e) {
            settings.onHide.call($dialog);
          });
        }
        // Opening dialog
        $dialog.modal("show");
      },
      // Closes dialog
      hide: function () {
        $dialog.modal("hide");
      },
    };
  })(jQuery);