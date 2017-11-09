var urlUsers = 'https://randomuser.me/api/?results=10';

new Vue({
    el: '#app',
    created: function() {
        this.getUsers();
    },
    data: {
        lists: []
    },
    methods: {
        getUsers: function (){
            this.$http.get(urlUsers).then(function(response){
                this.lists = response.data.results;
            });
        }
    }
});