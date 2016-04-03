(function($) {
	$.fn.imageUpload = function(url, options) {
		if (url) {
			var settings = $.extend({
				uploadButtonText: '���������',
				previewImageSize: 200,
				onSuccess: function(response) {

				}
			}, options);

			return this.each(function() {
				$(this).html('\
					<div>\
					<label class="upload_photo">\
						<input type="file" name="file" id="file-field" multiple="false" class="inputfile" accept="image/jpeg,image/jpg,image/png,image/gif"/>\
						<img style="width: 60%" class="background" src="../img/background.jpg">\
						</label>\
					</div>\
					<div id="img-container">\
					 	<ul style="list-style-type: none; margin-left: 0;padding-left: 0;" id="img-list"></ul>\
					</div>\
					<span id="upload-status"></span>\
					<div style="width: 80%;" type="button" id="upload-images" class="btn btn-info btn-dark">' + settings.uploadButtonText + '</div></form>\
				');

				var fileInput = $('#file-field');
				var imgList = $('ul#img-list');
				var dropBox = $('#img-container');
				var uploadButton = $('#upload-images');
				var uploadStatus = $('#upload-status');

				fileInput.bind({
					change: function() {
						displayFiles(this.files);
					}
				});

				dropBox.bind({
					dragenter: function() {
						$(this).addClass('highlighted');
						return false;
					},
					dragover: function() {
						return false;
					},
					dragleave: function() {
						$(this).removeClass('highlighted');
						return false;
					},
					drop: function(e) {
						var dt = e.originalEvent.dataTransfer;
						displayFiles(dt.files);
						return false;
					}
				});

				function displayFiles(files) 
				{
					$.each(files, function(i, file) {      
						if (!file.type.match(/image.*/)) 
							return true;           
					    var li = $('<li/>').appendTo(imgList);
					    var img = $('<img/>').appendTo(li);
					    var reader = new FileReader();
			
					    li.get(0).file = file;
						reader.onload = (function(aImg) {
							return function(e) {
								aImg.attr('src', e.target.result);
								aImg.attr('width', settings.previewImageSize);
							};
						})(img);
						reader.readAsDataURL(file);
						$('.upload_photo').remove();
					});
				}

				uploadButton.click(function () {
					var formdata = new FormData;
					if (settings)
						for(var key in settings) {
							formdata.append(key, settings[key]);
						}

					imgList.children("li").each(function(indx) {
						formdata.append("file[]", $(this).get(0).file);

					});

					xhr = new XMLHttpRequest();
					xhr.open("POST", url);
					xhr.send(formdata);
					xhr.onreadystatechange = function () {
						if (xhr.readyState == 4) {
					        if (xhr.status == 200) {
					            settings.onSuccess(xhr.responseText);
					        }
					    }	
					};
				});
			});	
		}
		else {
			console.log("Please enter valid URL for the upload.php file.");
			return false;
		}
	}
})(jQuery);