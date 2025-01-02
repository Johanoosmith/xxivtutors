/**
 * image Browser
 *
 */

$.widget("custom.dsImageChoose", {
  options: {
    className: "ds-image-choose",
	inputRequired: '',
    width: 200,
    height: 200,
    imageName: "image_name",
    placeHolder: "images/default-image.png",
    imageAccept: "image/*",
    imageSize: "2097152",
    removeText: "Remove",
    fileExtensions: ["jpg", "jpeg", "gif", "png", "pdf"],
    heightWidthEnable: 0, //0 no height & width 1 add height & width
    inputClass: '',
    pdfIcon: "images/pdf-icon1.jpg",
    removeCallBack: function (element, options) {
      return true;
    },
	
  },
  _isset: function (variable) {
    return typeof (variable) !== "undefined" && variable !== null && variable !== '';
  },
  _create: function () {
    this.options.name = this._constrain(this.options.name);

    var $this = this;
    var options = this.options;
    //console.log(this.element);
    //var dataAttr = this.element.data();
    //alert(dataAttr.removeText);
    //options.removeText = this._isset(dataAttr.removeText) ? dataAttr.removeText : options.removeText;


    options.removeText = this._isset(this.element.attr("data-removeText")) ? this.element.attr("data-removeText") : options.removeText;
    options.width = this._isset(this.element.attr("data-width")) ? this.element.attr("data-width") : options.width;
    options.height = this._isset(this.element.attr("data-height")) ? this.element.attr("data-height") : options.height;
    options.imageName = this._isset(this.element.attr("data-imageName")) ? this.element.attr("data-imageName") : options.imageName;
    options.placeHolder = this._isset(this.element.attr("data-placeHolder")) ? this.element.attr("data-placeHolder") : options.placeHolder;
    options.imageAccept = this._isset(this.element.attr("data-imageAccept")) ? this.element.attr("data-imageAccept") : options.imageAccept;
    options.imageSize = this._isset(this.element.attr("data-imageSize")) ? this.element.attr("data-imageSize") : options.imageSize;
    options.removeText = this._isset(this.element.attr("data-removeText")) ? this.element.attr("data-removeText") : options.removeText;
    options.fileExtensions = this._isset(this.element.attr("data-fileExtensions")) ? this.element.attr("data-fileExtensions") : options.fileExtensions;
    options.heightWidthEnable = this._isset(this.element.attr("data-heightWidthEnable")) ? this.element.attr("data-heightWidthEnable") : options.heightWidthEnable;

    options.inputClass = this._isset(this.element.attr("data-inputClass")) ? this.element.attr("data-inputClass") : options.inputClass;

    options.pdfIcon = this._isset(this.element.attr("data-pdfIcon")) ? this.element.attr("data-pdfIcon") : options.pdfIcon;
	
	options.inputRequired = this._isset(this.element.attr("data-inputRequired")) ? this.element.attr("data-inputRequired") : options.inputRequired;


    var element = this.element;
    var _placeHolder = this.element.attr("data-image-exist");
    var placeHolder = options.placeHolder;

    if (_placeHolder) {
      placeHolder = _placeHolder;
    }

    var idName = this.element.attr("id");
    var id = "choose-file-" + idName;
    var fileInput = $("<input>", {
      type: "file",
      id: id,
      class: "ds-image-choose-file-input " + options.inputClass,
      name: options.imageName,
      accept: options.imageAccept,
    });

    var labelClass = "ds-image-choose-label label-file-" + idName;
    var fileLabel = $("<label>", {
      //  for: id,
      class: labelClass
    });

    var imageClass = "img-file-" + idName;

    if (options.fileExtensions == 'mp4') {
      if (_placeHolder) {
        var fileImage = '<video class="ds-image-choose-img-preview ds-image-choose-video-preview" src="' + placeHolder + '">';
      } else {
        var fileImage = $("<img>", {
          src: placeHolder,
          class: "ds-image-choose-img-preview",
          id: imageClass,
        });
      }
    } else if (options.heightWidthEnable) {
      var fileImage = $("<img>", {
        src: placeHolder,
        class: "ds-image-choose-img-preview",
        id: imageClass,
        width: options.width,
        height: options.height,
      });
    } else {
      var fileImage = $("<img>", {
        src: placeHolder,
        class: "ds-image-choose-img-preview",
        id: imageClass,
      });
    }

    fileInput.change(function () {
      const files = this.files;
      if (files) {
        var validExtensions = options.fileExtensions;
        var fileExtension = files[0].name.split(".").pop().toLowerCase();
        if (validExtensions.indexOf(fileExtension) === -1) {
          Swal.fire({
            title: "File Type",
            text: "Invalid file type please upload valid file",
            icon: "warning",
          });
          return false;
        } else if (this.files[0].size > options.imageSize) {
          Swal.fire({
            title: "File Size",
            text: "Please upload file less than 2 MB.",
            icon: "warning",
          });
        } else {
          if (fileExtension == 'pdf') {
            console.log('fileExtension', options.pdfIcon);
            $("#" + imageClass).attr("src", options.pdfIcon);
            element.addClass("ds-image-uploaded");
            /** remove requried class */
            var idName = element.attr("id");
            var id = "choose-file-" + idName;
            $("#" + id).removeClass('required');
          } else if (fileExtension == 'mp4') {
            console.log("#mp4 ");
            var reader = new FileReader();
            reader.onload = function (e) {
              // $("#" + imageClass).attr("src", e.target.result);
              console.log("#" + imageClass);
              $("#" + imageClass).after('<video class="ds-image-choose-img-preview ds-image-choose-video-preview" src="' + e.target.result + '">');
              $("#" + imageClass).hide();
              element.addClass("ds-image-uploaded");
              /** remove requried class */
              var idName = element.attr("id");
              var id = "choose-file-" + idName;
              $("#" + id).removeClass('required');

            };
            reader.readAsDataURL(this.files[0]);
          } else {
            var reader = new FileReader();
            reader.onload = function (e) {
              $("#" + imageClass).attr("src", e.target.result);
              element.addClass("ds-image-uploaded");
              /** remove requried class */
              var idName = element.attr("id");
              var id = "choose-file-" + idName;
              $("#" + id).removeClass('required');

            };
            reader.readAsDataURL(this.files[0]);
          }
          $this._removeImage(idName, imageClass, options, element);
        }
      }
    });

    element.append(fileInput);
    //element.append(fileLabel);
    fileLabel.append(fileImage);
    if (_placeHolder) {
      this._removeImage(idName, imageClass, options, element);
    }
    element.addClass(options.className);
    element.addClass("ds-image-choose");
    if (options.heightWidthEnable) {
      element.css("width", options.width);
      element.css("height", options.height);
    }
    if (_placeHolder) {
      element.addClass("ds-image-uploaded");
    }
    element.append(fileLabel);
    this.refresh();
  },
  _removeImage: function (className, imageClass, options, element) {
    var anchorCloseClass =
      "remove_pet_img ds-image-choose-anchor-close anchor-close-file-" + className;
    var fileAnchorClose = $("<a>", {
      class: anchorCloseClass,
      href: "javascript:void(0);",
    });
    //fileAnchorClose.append(options.removeText);
    fileAnchorClose.append('<i class="fa fa-close"></i>');

    fileAnchorClose.click(async function () {
      var _placeHolder = element.attr("data-image-exist");

      if (_placeHolder != "") {
        console.log('_placeHolder','not blank')
        Swal.fire({
          icon: "warning",
          title: "Are you sure you want to delete this record?",
          text: "If you delete this, it will be gone forever.",
          showCancelButton: true,
          confirmButtonColor: "#dd3333",
          cancelButtonColor: "#a8dab5",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel please!",
          dangerMode: true
        }).then(async (result) => {
          if (result.isConfirmed) {
            if (typeof options.removeCallBack === "function") {
              await options.removeCallBack(options, element, () => {
                $("#" + imageClass).attr("src", options.placeHolder);
                fileAnchorClose.parent().remove();
                element.attr("data-inputclass", "required");
                element.attr("data-image-exist", "");
                element.removeClass("ds-image-uploaded");
                var ext = element.attr("data-fileextensions");
                console.log(ext, "ext");
                if (ext == 'mp4') {
                  $("#" + element.attr("id") + ' .ds-image-choose-video-preview').remove();
                  $("#" + element.attr("id") + ' label img').css("display", "block");
                  $("#" + element.attr("id")).attr("data-image-exist", "");

                  var fileImage = $("<img>", {
                    src: options.placeHolder,
                    class: "ds-image-choose-img-preview",
                    id: imageClass,
                  });
                  if (($("#" + element.attr("id"))) == 'video-img-1') {
                    $("#" + element.attr("id")).addClass('required');
                  }

                  $("#" + element.attr("id") + ' label').append(fileImage);
                  console.log("#" + element.attr("id") + ' label');
                }

                var idName = element.attr("id");
                var id = "choose-file-" + idName;
                $("#" + id).val("");
                $("#" + id).addClass(options.inputClass);
				        $("#" + id).addClass(options.inputRequired);
				
              });
            }
          }
        });
      } else {
        console.log('_placeHolder', 'blank')
        $("#" + imageClass).attr("src", options.placeHolder);
        fileAnchorClose.parent().remove();
        element.attr("data-inputclass", "required");
        element.attr("data-image-exist", "");
        element.removeClass("ds-image-uploaded");
        var ext = element.attr("data-fileextensions");
        console.log(ext, "ext");
        if (ext == 'mp4') {
          $("#" + element.attr("id") + ' .ds-image-choose-video-preview').remove();
          $("#" + element.attr("id") + ' label img').css("display", "block");
          $("#" + element.attr("id")).attr("data-image-exist", "");
        }
        var idName = element.attr("id");
        var id = "choose-file-" + idName;
        $("#" + id).val("");
        $("#" + id).addClass(options.inputClass);
        $("#" + id).addClass(options.inputRequired);
      }
    });

    var spanAnchorClose = $("<span>", {
      class: "ds-span-anchor-close",
    });
    spanAnchorClose.append(fileAnchorClose);
    element.append(spanAnchorClose);
    element.removeClass("ds-image-uploaded");
  },

  _setOption: function (key, value) {
    if (key === "name") {
      name = this._constrain(name);
      this._super(key, name);
    }
    if (key === "idName") {
      idName = this._constrain(idName);
      this._super(key, idName);
    }
  },
  _setOptions: function (options) {
    this._super(options);
    this.refresh();
  },
  refresh: function () { },
  _constrain: function (value) {
    return value;
  },
});
