/*global CKEDITOR, $, _*/
CKEDITOR.plugins.add('tauuploader',
    {
        init: function(editor) {
            var uploadFiles = editor.config.uploaderConfig.uploadFiles;
            var onUploadError = editor.config.uploaderConfig.onUploadError || _.noop;
            var b64toBlob = function(b64Data, contentType, sliceSize) {
                contentType = contentType || '';
                sliceSize = sliceSize || 512;
                var byteCharacters = atob(b64Data);
                var byteArrays = [];
                for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                    var slice = byteCharacters.slice(offset, offset + sliceSize);

                    var byteNumbers = new Array(slice.length);
                    for (var i = 0; i < slice.length; i++) {
                        byteNumbers[i] = slice.charCodeAt(i);
                    }

                    var byteArray = new Uint8Array(byteNumbers);

                    byteArrays.push(byteArray);
                }
                return new Blob(byteArrays, {type: contentType});
            };

            var insertToEditor = function(file) {
                var element;
                if (uploadFiles.isImage(file)) {
                    element = CKEDITOR.dom.element
                        .createFromHtml('<img src="' + file.uri + '">');
                } else {
                    element = CKEDITOR.dom.element
                        .createFromHtml('<a href="' + file.uri + '"> ' + file.name + '</a>');
                }
                editor.insertElement(element);
            };

            editor.addFeature({
                allowedContent: 'img[!src,id];'
            });

            editor.on('instanceReady', function() {
                var $editor = $(editor.editable().$);
                $editor.addClass('i-role-uploader-area').fileupload({
                    add: function(event, data) {
                        if (!data.files || data.files.length === 0) {
                            return;
                        }
                        uploadFiles.upload(data).then(insertToEditor, onUploadError);
                    },
                    url: editor.config.uploaderConfig.url,
                    formData: editor.config.uploaderConfig.formData,
                    dropZone: $editor,
                    pasteZone: $editor
                });
                
                editor.on('beforePaste', function (e) {
                    if (e.data.dataTransfer) {
                        var dt = e.data.dataTransfer.$;
                        if(dt && dt.items){
                            $.each(dt.items, function(i, val) {
                                if(val.kind === 'file') {
                                    e.cancel();
                                }
                            });
                        }
                    }
                });

                // Paste from clipboard workaround for Firefox.
                editor.on('paste', function(e) {
                    var data = e.data,
                        html = (data.html || ( data.type && data.type == 'html' && data.dataValue));

                    if (!html || !_.isString(html)) {
                        return;
                    }
                    var match = html.match(/<img src="data:image\/png;base64,(.*?)".*?>/);
                    if (match && match[1]) {
                        var imageData = match[1];
                        e.cancel();
                        var blob = b64toBlob(imageData, 'image/png');
                        blob.name = new Date().toDateString();
                        uploadFiles.handleUploadResponse($editor.fileupload('send', {
                            files: [blob]
                        })).then(insertToEditor, onUploadError);
                    }
                });
            });
        } //Init
    });
