new Vue({
    el: '#editor',
    data: {
      input: '# h1\r\n## h2\r\n### h3\r\n - [ ] Task 1\r\n - [ ] Task 2\r\n\r\n|ID|STATUS|TITLE|COMMENTS|STARTDATE|FINISHDATE|\r\n|--|------|-----|--------|---------|----------|\r\n|1|(TO-DO)|TITLE|COMMENTS| | |'
    },
    computed: {
      compiledMarkdown: function () {
        return marked(this.input, { sanitize: true })
      }
    },
    methods: {
      update: _.debounce(function (e) {
        this.input = e.target.value
      }, 300)
    }
  })