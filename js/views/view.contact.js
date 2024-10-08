(($) => {
  $.validator.addMethod(
    "noSpace",
    (value, element) => {
      if ($(element).attr("required")) {
        return value.search(/^(?! *$)[^]+$/) == 0;
      }
      return true;
    },
    "Please fill this empty field."
  );
  $.validator.addClassRules({ "form-control": { noSpace: true } });
  $(".contact-form").each(function () {
    $(this).validate({
      errorPlacement(error, element) {
        if (
          element.attr("type") == "radio" ||
          element.attr("type") == "checkbox"
        ) {
          error.appendTo(element.closest(".form-group"));
        } else if (
          element.is("select") &&
          element.closest(".custom-select-1")
        ) {
          error.appendTo(element.closest(".form-group"));
        } else {
          if (element.closest(".form-group").length) {
            error.appendTo(element.closest(".form-group"));
          } else {
            error.insertAfter(element);
          }
        }
      },
      submitHandler(form) {
        const $form = $(form),
          $messageSuccess = $form.find(".contact-form-success"),
          $messageError = $form.find(".contact-form-error"),
          $submitButton = $(this.submitButton),
          $errorMessage = $form.find(".mail-error-message"),
          submitButtonText = $submitButton.val();
        $submitButton
          .val(
            $submitButton.data("loading-text")
              ? $submitButton.data("loading-text")
              : "Loading..."
          )
          .attr("disabled", true);
        const formData = $form.serializeArray(),
          data = {};
        $(formData).each((index, { name, value }) => {
          if (data[name]) {
            data[name] = data[name] + ", " + value;
          } else {
            data[name] = value;
          }
        });
        if (data["g-recaptcha-response"] != undefined) {
          data["g-recaptcha-response"] = $form
            .find("#g-recaptcha-response")
            .val();
        }
        $.ajax({ type: "POST", url: $form.attr("action"), data }).always(
          ({ response, errorMessage, responseText }, textStatus, jqXHR) => {
            $errorMessage.empty().hide();
            if (response == "success") {
              $messageSuccess.removeClass("d-none");
              $messageError.addClass("d-none");
              $form
                .find(".form-control")
                .val("")
                .blur()
                .parent()
                .removeClass("has-success")
                .removeClass("has-danger")
                .find("label.error")
                .remove();
              if ($messageSuccess.offset().top - 80 < $(window).scrollTop()) {
                $("html, body").animate(
                  { scrollTop: $messageSuccess.offset().top - 80 },
                  300
                );
              }
              $form.find(".form-control").removeClass("error");
              $submitButton.val(submitButtonText).attr("disabled", false);
              return;
            } else if (
              response == "error" &&
              typeof errorMessage !== "undefined"
            ) {
              $errorMessage.html(errorMessage).show();
            } else {
              $errorMessage.html(responseText).show();
            }
            $messageError.removeClass("d-none");
            $messageSuccess.addClass("d-none");
            if ($messageError.offset().top - 80 < $(window).scrollTop()) {
              $("html, body").animate(
                { scrollTop: $messageError.offset().top - 80 },
                300
              );
            }
            $form.find(".has-success").removeClass("has-success");
            $submitButton.val(submitButtonText).attr("disabled", false);
          }
        );
      },
    });
  });
  $("#contactFormAdvanced").validate({
    onkeyup: false,
    onclick: false,
    onfocusout: false,
    rules: {
      captcha: { captcha: true },
      "checkboxes[]": { required: true },
      radios: { required: true },
    },
    errorPlacement(error, element) {
      if (
        element.attr("type") == "radio" ||
        element.attr("type") == "checkbox"
      ) {
        error.appendTo(element.closest(".form-group"));
      } else if (element.is("select") && element.closest(".custom-select-1")) {
        error.appendTo(element.closest(".form-group"));
      } else {
        error.insertAfter(element);
      }
    },
  });
  $(".contact-form-recaptcha-v3").each(function () {
    $(this).validate({
      errorPlacement(error, element) {
        if (
          element.attr("type") == "radio" ||
          element.attr("type") == "checkbox"
        ) {
          error.appendTo(element.closest(".form-group"));
        } else if (
          element.is("select") &&
          element.closest(".custom-select-1")
        ) {
          error.appendTo(element.closest(".form-group"));
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler(form) {
        const $form = $(form),
          $messageSuccess = $form.find(".contact-form-success"),
          $messageError = $form.find(".contact-form-error"),
          $submitButton = $(this.submitButton),
          $errorMessage = $form.find(".mail-error-message"),
          submitButtonText = $submitButton.val();
        $submitButton
          .val(
            $submitButton.data("loading-text")
              ? $submitButton.data("loading-text")
              : "Loading..."
          )
          .attr("disabled", true);
        const recaptchaSrcURL = $("#google-recaptcha-v3").attr("src"),
          newURL = new URL(recaptchaSrcURL),
          site_key = newURL.searchParams.get("render");
        grecaptcha.execute(site_key, { action: "contact_us" }).then((token) => {
          const formData = $form.serializeArray(),
            data = {};
          $(formData).each((index, { name, value }) => {
            data[name] = value;
          });
          data["g-recaptcha-response"] = token;
          $.ajax({ type: "POST", url: $form.attr("action"), data }).always(
            ({ response, errorMessage, responseText }, textStatus, jqXHR) => {
              $errorMessage.empty().hide();
              if (response == "success") {
                $messageSuccess.removeClass("d-none");
                $messageError.addClass("d-none");
                $form
                  .find(".form-control")
                  .val("")
                  .blur()
                  .parent()
                  .removeClass("has-success")
                  .removeClass("has-danger")
                  .find("label.error")
                  .remove();
                if ($messageSuccess.offset().top - 80 < $(window).scrollTop()) {
                  $("html, body").animate(
                    { scrollTop: $messageSuccess.offset().top - 80 },
                    300
                  );
                }
                $form.find(".form-control").removeClass("error");
                $submitButton.val(submitButtonText).attr("disabled", false);
                return;
              } else if (
                response == "error" &&
                typeof errorMessage !== "undefined"
              ) {
                $errorMessage.html(errorMessage).show();
              } else {
                $errorMessage.html(responseText).show();
              }
              $messageError.removeClass("d-none");
              $messageSuccess.addClass("d-none");
              if ($messageError.offset().top - 80 < $(window).scrollTop()) {
                $("html, body").animate(
                  { scrollTop: $messageError.offset().top - 80 },
                  300
                );
              }
              $form.find(".has-success").removeClass("has-success");
              $submitButton.val(submitButtonText).attr("disabled", false);
            }
          );
        });
      },
    });
  });
}).apply(this, [jQuery]);
