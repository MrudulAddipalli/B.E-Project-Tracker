CKEDITOR.plugins.add('mentions', {
        requires: 'widget',
        init: function(editor) {
            var MentionPlugin = editor.config.MentionPlugin;
            if (MentionPlugin) {
                var mention = new MentionPlugin(editor);
            }
        }
});
