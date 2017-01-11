<template>
  <div id="editor">

  </div>
</template>

<script>

var toolbarOptions = [
  [{ 'size': ['small', false, 'large', 'huge'] }],
  ['bold','italic','underline','strike'],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  ['code-block','formula'],
  ['clean']
];

export default {
  props: [],
  mounted() {
    var quill = new Quill('#editor', {
      theme: 'snow',
      modules: {
        syntax: true,
        formula: true,
        toolbar: toolbarOptions
      },
      placeholder: 'Write your Heart ...'
    });

    var Delta = Quill.import('delta');

    // Store accumulated changes
    var change = new Delta();
    quill.on('text-change', function(delta) {
      change = change.compose(delta);
    });

    var vm = this;

    // Save periodically
    setInterval(function() {
      if (change.length() > 0) {
        // console.log('Saving changes', change);
        // Send partial changes
        // vm.$http.post('../api/save-note', {
        //   partial: JSON.stringify(change)
        // });

        // Send entire document
        vm.$http.post('../api/save-note', {
          doc: JSON.stringify(quill.getContents())
        });

        change = new Delta();
      }
    }, 5*1000);

    // Check for unsaved data
    window.onbeforeunload = function() {
      if (change.length() > 0) {
        return 'There are unsaved changes. Are you sure you want to leave?';
      }
    }
  }
}
</script>

<style lang="css">
</style>
