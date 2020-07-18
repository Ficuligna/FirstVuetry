
// import VueSimpleAlert from "vue-simple-alert";
// import Vue from "vue"
require('./bootstrap');
window.Vue = require('vue');


function init(){
  // Vue.use(VueSimpleAlert);
  token = $('meta[name="csrf-token"]').attr('content');
  console.log(token);
  const files = require.context('./', true, /\.vue$/i)
  files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
  const app = new Vue({
    el: '#app',
    data () {
      return {
        tasks: [],
        selected: " ",
        message: ""
      }
    },
    methods: {
      addTask: function () {
        this.tasks.push({})
      },

    }

  });
}

$(document).ready(init);
